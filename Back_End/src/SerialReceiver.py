#File: SerialReceiver.py
#Author: Peter Williams, Roja Nunna
#Class: ENGS89
#Date: Novemeber 6, 2011
#Modified: Feb 2013, Peter Williams - implement optional splashscreen
__author__="peter"
__date__ ="$Jun 29, 2012 3:38:00 PM$"

import serial
import time
import sys
import Xlib.display
from struct import unpack
import threading
#import subprocess
import numpy
import ConfigParser
import os

class SerialReceiver(threading.Thread):
    def __init__(self, parent):
        threading.Thread.__init__(self)

#        print "NO MOUSE"
#        return

        print "SerialReceiver.py - Initializing..."
        self.path = os.getcwd()
        self.calib = False
        self.parent = parent
        self.display, self.root = self.initXlib()

        self.current_state = False
        self.freq_count = 0
        self.pulse_count = 0
        self.last_state = True
        self.click_hold = False
        self.release = False
        self.release_count = 0
        self.currentCalibration = None
        self.calibration_coords = []
#        self.xRaw, self.yRaw = None, None
        self.pulseLength = 0
        self.update_timer = 0
        self.calibHomo = numpy.zeros((3, 3))
        self.screenSize = (parent.win.get_screen().get_width(), parent.win.get_screen().get_height())
        self.wiiRes = None
        self.calibActive = False
        self.mouseDown = False
        self.pulseOption = None
        self.noActivity = 0
        self.pointAccepted = False
        

#        ControlParams
        self.xAccel = None
        self.yAccel = None
        self.pulseSensitivity = None
        self.releaseSensitivity = None
        self.numPulses = None
        self.pulseLengthMin = None
        self.mouseUpdateRate = None
        self.noActivityLimit = None
        self.delay = None
        self.calibPulses = None


#        Options
        self.active = None
        self.reverseX = None
        self.reverseY = None
#
        self.parseConfig()
        
        if self.active == True:
            self.ser = serial.Serial('/dev/USBSerial', 115200)
	#Skip 2013 02 21
	else:
	    print "SerialReceiver.py - Wand NOT active"

        self.xScale = float(self.wiiRes[0])/self.screenSize[0]
        self.yScale = float(self.wiiRes[1])/self.screenSize[1]


    def initXlib(self):
        disp = Xlib.display.Display()
        screen = disp.screen()
        root = screen.root
        return disp, root

    def parseConfig(self):
        parser = ConfigParser.ConfigParser()
        parser.read(self.path + '/config.py')
        self.xAccel = parser.getint('ControlParams', 'xAccel')
        self.yAccel = parser.getint('ControlParams', 'yAccel')
        self.pulseSensitivity = parser.getint('ControlParams', 'pulseSensitivity')
        self.releaseSensitivity = parser.getint('ControlParams', 'releaseSensitivity')
        self.numPulses = parser.getint('ControlParams', 'numPulses')
        self.pulseOption = self.numPulses
        self.pulseLengthMin = parser.getint('ControlParams', 'pulseLengthMin')
        self.mouseUpdateRate = parser.getint('ControlParams', 'mouseUpdateRate')
        self.noActivityLimit = parser.getint('ControlParams', 'noActivityLimit')
        self.delay = parser.getfloat('ControlParams', 'delay')
        self.active = parser.getboolean('FPGAOptions', 'active')
        self.reverseX = parser.getboolean('FPGAOptions', 'reversex')
        self.reverseY = parser.getboolean('FPGAOptions', 'reversey')
        self.wiiRes = (parser.getint('WResolution', 'x'), parser.getint('WResolution', 'y'))
        self.calibPulses = parser.getint('Calibration', 'calibPulses')
            
    def restoreCalibration(self):
        parser = ConfigParser.ConfigParser()
        parser.read(self.path + '/config.py')
        self.calibActive = True
        for i in range(3):
            for j in range(3):
                self.calibHomo[i, j] = parser.getfloat('Calibration', str(i) + str(j))

    def updateMouse(self, xCoord, yCoord):
        if self.click_hold == True and self.mouseDown != True:
            Xlib.ext.xtest.fake_input(self.display, Xlib.X.ButtonPress, 1)
            self.mouseDown = True
            self.update_timer = self.mouseUpdateRate
        if self.release == True:
            Xlib.ext.xtest.fake_input(self.display, Xlib.X.ButtonRelease, 1)
            self.mouseDown = False
            self.release = False
        self.update_timer += 1
        if self.update_timer >= self.mouseUpdateRate:
            self.moveMouse(xCoord, yCoord)
            self.update_timer = 0


    def moveMouse(self, xCoord, yCoord):
#        print time.time()
        self.root.warp_pointer(xCoord, yCoord)
        self.display.sync()

#        subprocess.call(['xdotool', 'mousemove', str(xCoord), str(yCoord)])


    def scale(self, x, y):
        if self.calibActive == False:
            xMin, xMax = self.wiiRes[0]/2 - (self.wiiRes[0]/self.xAccel)/2, self.wiiRes[0]/2 + (self.wiiRes[0]/self.xAccel)/2
            yMin, yMax = self.wiiRes[1]/2 - (self.wiiRes[1]/self.yAccel)/2, self.wiiRes[1]/2 + (self.wiiRes[1]/self.yAccel)/2
            if (x < xMin) or (x > xMax) or (y < yMin) or (y > yMax):
                return None, None #FIX THIS
            else:
#old code

#                if self.reverseX == False:
#                    return int(round((x-xMin)/(self.xScale/self.xAccel), 0)), int(round((y-yMin)/(self.yScale/self.yAccel), 0))
#                else:
#                    return int(self.screenSize[0] - round((x-xMin)/(self.xScale/self.xAccel), 0)), int(round((y-yMin)/(self.yScale/self.yAccel), 0))

#start new code:
		if self.reverseX == False:
			xReturn = round((x-xMin)/(self.xScale/self.xAccel), 0)
		else:
			xReturn = self.screenSize[0] - round((x-xMin)/(self.xScale/self.xAccel), 0)

		if self.reverseY == False:
			yReturn = round((y-yMin)/(self.yScale/self.yAccel), 0)
		else:
			yReturn = self.screenSize[1] - round((y-yMin)/(self.yScale/self.yAccel), 0)

		return (int(xReturn), int(yReturn))
#end new code

        else:
            uwarped = numpy.array([[x], [y], [1]])
            warped = numpy.dot(numpy.linalg.inv(self.calibHomo), uwarped)
            return (int(warped[0]/warped[2]), int(warped[1]/warped[2]))

    def frequencyDetect(self):
#        print "SerialReceiver.py - detecting"
        if self.freq_count >= self.pulseSensitivity:
            self.pulse_count = 0
            self.freq_count = 0
            self.pulseLength = 0
        else:
            if self.current_state != self.last_state and self.pulseLength >= self.pulseLengthMin:
                self.pulse_count += 1
                self.noActivity = 0
                self.pulseLength = 0
            elif self.current_state != self.last_state:
                self.pulseLength = 0
                self.noActivity = 0 #????
            else:
                self.noActivity += 1
            if self.noActivity >= self.noActivityLimit and self.pulse_count > 0:
                self.pulse_count = 0
            if self.pulse_count >= self.pulseOption:
                self.click_hold = True
                if self.calib == True:
                    self.pointAccepted = True
#                    sys.exit(0)
#                    print "Click Hold"
#                    print self.freq_count
                self.pulse_count = 0
                self.freq_count = 0
                self.pulseLength = 0
            self.freq_count += 1
            self.pulseLength += 1

    def releaseDetect(self):
        if self.release_count >= self.releaseSensitivity:
            self.release = True
            self.click_hold = False
            self.release_count = 0
        if self.current_state == False:
            self.release_count = 0
        else:
            self.release_count += 1

    def sRead(self):
        data = (0,0,1)
        found = False
        buff = self.ser.read(5)
        
        i = 0

        while found == False:
            try:
                b1 = bin(unpack("B", buff[i])[0])[2:]
                if len(b1) <= 7:
                    b2 = bin(unpack("B", buff[i+1])[0])[2:]
                    b3 = bin(unpack("B", buff[i+2])[0])[2:]
                    found = True
            except:
                print "SerialReceiver: ~~~~~~Caught Exception~~~~~~"
#                print sys.exc_info()[0]
#                sys.stderr.write('Tracking Error')
                return
            else:
                i+=1

        xBin = b1 + b3[1:4]
        yBin = b2[1:] + b3[4:7]

        xRaw = int(xBin, 2)
        yRaw = int(yBin, 2)

        
        x, y = self.scale(xRaw, yRaw)

        if (xRaw == (self.wiiRes[0]-1) and yRaw == (self.wiiRes[0]-1)):
            self.current_state = False
        else:
            self.current_state = True

        if self.click_hold == True:
            self.releaseDetect()
        else:
            self.frequencyDetect()

#        if self.current_state == True:
#            print "Data"
#        else:
#            print "No Data"

        if self.current_state == True and self.calib != True and x != None:
            self.updateMouse(x, y)
            

        if self.calib == True:
            self.pulseOption = self.calibPulses
            self.pulseSensitivity = self.pulseSensitivity * int(1.5 * self.calibPulses/self.numPulses)
            if self.pointAccepted == True:
                self.calibration_coords.append((xRaw, yRaw))
                if len(self.calibration_coords) == 4:
                    self.calibrate()
                    self.currentCalibration = self.calibration_coords
                    self.parent.calibrationComplete()
                else:
                    self.parent.advanceCalibration(len(self.calibration_coords))
                self.pointAccepted = False


        self.last_state = self.current_state

    def normalMode(self):
        self.calibration_coords = []
        self.pulseOption = self.numPulses
        self.pulseSensitivity = self.pulseSensitivity / int(1.5 * self.calibPulses/self.numPulses)
        self.click_hold = False
        self.calib = False

    def calibrate(self):
        screen_coords = numpy.array([(0, 0), (self.screenSize[0], 0), (self.screenSize[0], self.screenSize[1]), (0, self.screenSize[1])])
        calib_coords = numpy.array([self.calibration_coords[0], self.calibration_coords[1], self.calibration_coords[2], self.calibration_coords[3], ])
        self.calibHomo = self.homography(screen_coords, calib_coords)
        self.writeMatrix()
        self.calibActive = True

    def writeMatrix(self):
        parser = ConfigParser.ConfigParser()
        parser.read('config.py')
        for i in range(3):
            for j in range(3):
                parser.set('Calibration', str(i) + str(j), self.calibHomo[i, j])
        with open('config.py', 'wb') as configfile:
            parser.write(configfile)

    #    Recovers a homography to transform 'img1' into 'img2' coordinates
    def homography(self, img1, img2):
        b = img2.flatten()
        A = numpy.zeros((2*img1.shape[0], 8))
        for i in range(0,img1.shape[0]):
            temp = 2*i
            A[temp, 0:3] = self.homogen(img1[i])
            A[temp, 6:] = [(-img2[i][0] * img1[i][0]), (-img2[i][0] * img1[i][1])]
            A[temp+1, 3:6] = self.homogen(img1[i])
            A[temp+1, 6:] = [(-img1[i][0] * img2[i][1]), (-img1[i][1] * img2[i][1])]

        x = numpy.linalg.solve(A,b)
        v = numpy.array([1])
        t = numpy.hstack((x,v))
        homog = t.reshape((3,3))
#        print "Homography:", homog
        return homog

#    Homogenous function.
    def homogen(self, element):
        return numpy.array([element[0], element[1], 1])

    def run(self):
        print "SerialReceiver: Mouse Control Active..."
        while self.active == True:
            self.sRead()
#            self.ser.flushInput()
#            time.sleep(self.delay)
        print "SerialReceiver: Mouse Control Stopped"
