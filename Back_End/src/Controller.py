#File: Controller.py
#Author: Peter Williams, Roja Nunna
#Class: ENGS89
#Date: Novemeber 6, 2011

#winter 2013 - modified by Peter to make SplashScreen optional [reads "SplashScreen = active" from config.py]

__author__="group 18"
__date__ ="$Nov 6, 2011 11:53:23 AM$"

import gtk
import fcntl
import sys
import os
import string
import subprocess
import ConfigParser

from ContentLoader import ContentLoader
from Keyboard import Keyboard
from Whiteboard import Whiteboard
from Calibration import Calibration
from SerialReceiver import SerialReceiver
from MyPDFViewer import MyPDFViewer
from Toolbar import Toolbar

#This class is designed initialize the GUI and handle interactions between
#independent classes to reduce coupling.
class Controller(object):
    def __init__(self):
        self.path = os.getcwd()
        self.rootAddr = "/var/www/Front_End/"

        parser = ConfigParser.ConfigParser()
        parser.read(self.path + '/config.py')
        self.xRes, self.yRes = parser.getint('SResolution', 'x'), parser.getint('SResolution', 'y')
        self.password = parser.get('Security', 'password')
        showSplashScreen = parser.getboolean('SplashScreen', 'active')

        self.win = self.createWindow(self.xRes, self.yRes)
        self.win.show()

        self.UI = SerialReceiver(self)
#        begin mouse control
        self.UI.start()

#        Initialize to zero to stop error
        self.splashResponse = 0
        if showSplashScreen:
            self.splashResponse = self.showSplashScreen()

        self.frame = gtk.VBox()
        self.widgetBox = gtk.HBox() #pack current widgets in here

#        'currentWidget' and 'currentScreen' are used to keep track of which
#        screen is currently active and what the viewable widget is.
#        This allows for generic methods switch between screens.
        self.currentScreen = None
        self.lastScreen = None
        self.xAccel_hold = None
        self.yAccel_hold = None

#        Initializes classes and builds GUI.
#        self.controlPanel = ControlPanel()
        self.contentLoader = ContentLoader(self.rootAddr)
        self.calibration = Calibration()
        self.pdfViewer = MyPDFViewer(self.widgetBox)
        self.whiteboard = Whiteboard(self.rootAddr)
        self.toolbar = Toolbar(self.rootAddr)
        self.keyboard = None

#        Create Connections
        self.createConnections()

#        Add Components to Window
        self.addComponents()


#        Test Vars
        self.keyboardActive = False
        self.calibrationActivated = False


#    Creates main window
    def createWindow(self, x, y):
        win = gtk.Window(gtk.WINDOW_TOPLEVEL)
        win.resize(x, y)
        win.set_decorated(False)
#        win.fullscreen()
        win.connect("destroy", self.windowDestroyed)
        return win

    def addComponents(self):
#        VBox
        self.frame.pack_start(self.widgetBox)
        self.frame.pack_start(self.toolbar.getWidget(), False)
        self.frame.show_all()

#        HBox
        self.widgetBox.pack_start(self.contentLoader.getWidget())
        self.widgetBox.pack_start(self.calibration.getWidget())
        self.widgetBox.pack_start(self.pdfViewer.getWidget())
        self.widgetBox.pack_start(self.whiteboard.getWidget())
        
        self.win.add(self.frame)


    def createConnections(self):
#        ContentLoader
        lst = self.contentLoader.getButtons()
        lst[0].connect("navigation-policy-decision-requested", self.webNavRequested)
        lst[1].connect("navigation-policy-decision-requested", self.webNavRequested)

#        Whiteboard
        lst = self.whiteboard.getButtons()
        lst[0].connect("clicked", self.saveWhiteboard)
        lst[1].connect("clicked", self.quitWhiteboard)

#        PDF Viewer
        lst = self.pdfViewer.getButtons()
        lst[0].connect("clicked", self.backFromCurrentScreen)

#        Toolbar
        lst = self.toolbar.getButtons()
        lst[0].connect("navigation-policy-decision-requested", self.toolbarClicked)
        
#    Method to add the passed widget to the main window and
#    update 'currentWidget' and 'currentScreen'
    def customAdd(self, screen):
        if self.currentScreen != None:
            self.currentScreen.hide()
        if self.currentScreen != self.lastScreen:
            self.lastScreen = self.currentScreen
        self.currentScreen = screen
        self.currentScreen.show()

    def backFromCurrentScreen(self, widget):
        self.customAdd(self.lastScreen)
        self.showToolbar()

    def initializeCalibration(self, widget):
        self.calibrationActivated = True
        self.customAdd(self.calibration)
        self.UI.calib = True
#        self.controlPanel.hide()

    def advanceCalibration(self, num):
        self.calibration.advanceImg(num)
        self.calibration.show() #Hacky workaround

    def calibrationComplete(self):
        self.calibration.reset()
        self.customAdd(self.lastScreen)
        self.UI.normalMode()

    def showSplashScreen(self):
        dialog = gtk.Dialog("LOOMA")
        dialog.set_size_request(800, 600)
        dialog.set_position(gtk.WIN_POS_CENTER)
        dialog.set_decorated(False)

        title = gtk.Image()
        title.set_from_file(self.path + "/Resources/SplashScreen/title.png")

        dialog.vbox.pack_start(title)

        dialog.add_button("Calibrate", 1)
        dialog.add_button("START", 2)
        dialog.add_button("Default", 3)

        dialog.action_area.set_size_request(200, 200)
        dialog.action_area.set_layout(gtk.BUTTONBOX_SPREAD)

        children = dialog.action_area.get_children()
        for child in children:
            child.set_size_request(200, 200)
            label = child.child
            label.set_markup("<span foreground=\"black\" size=\"20000\"><b>" + child.get_label() + "</b></span>")

        children[1].child.set_markup("<span foreground=\"black\" size=\"30000\"><b>" + children[1].get_label() + "</b></span>")
        dialog.set_focus(children[1])

        dialog.show_all()

        response = dialog.run()
        dialog.destroy()
        return response

    def initializePDFViewer(self, pdf, num):
        self.pdfViewer.open(pdf, num)
        self.customAdd(self.pdfViewer)
        self.hideToolbar()

    def exitPython(self, widget):
        self.customAdd(self.lastScreen)

    def webNavRequested(self, view, frame, req, action, decision, data=None):
        url = req.get_uri()
        print url
        ind = string.find(url, "goto=")
        if ind != -1:
            command = url[ind+5:]
            print "Command Issued: " , command
            return self.webCommandIssued(command, url, ind)
        else:
            if url[-13:-9] == ".pdf":
                modURL = "file://" + url[16:-9]
                num = int(url[-3:])
                self.initializePDFViewer(modURL, num)
                return True
            return False

    def webCommandIssued(self, command, url, ind):
        if command == "calibrate":
            self.initializeCalibration(None)
        elif command == "return":
            self.customAdd(self.lastScreen)
            self.contentLoader.swapWindow()
        elif command == "poweroff":
            self.powerDown()
        else:
            if command == "newtab": #This is duplicated in ContentLoader
                self.hideToolbar()
            elif command == "close":
                self.showToolbar() #Also duplicated
            return self.contentLoader.webCommandIssued(command, url, ind)
        return True

#    Not using this method currently
    def convertToPDF(self, widget):
#        file = self.path + "/Resources/impt.txt"
        file = self.path + "/Resources/power.ppt"
        subprocess.call(['oowriter', '-convert-to', 'pdf:writer_pdf_Export', '-outdir', self.path + "/Resources", file])
        subprocess.call(['rm', file])

    def saveWhiteboard(self, widget):
        self.whiteboard.saveCallback()

    def quitWhiteboard(self, widget):
        self.backFromCurrentScreen(widget)
        self.showToolbar()

    def toolbarClicked(self, view, frame, req, action, decision, data=None):
        url = req.get_uri()
        print "Toolbar Button Clicked: ", url
        ind = string.find(url, "goto=")
        if ind != -1:
            str = url[ind+5:]
            self.toolbarCommandIssued(str, ind)
            return False
        else:
            return False

    def toolbarCommandIssued(self, str, ind):
        locInd = string.find(str, "location=")
        command = str[0:locInd-1]
        location = str[locInd+9:]
        if self.calibrationActivated == True:
            self.calibration.reset()
            self.UI.normalMode()
            self.calibrationActivated = False
        if command == "home":
            self.contentLoader.openInMainFrame(location)
            self.customAdd(self.contentLoader)
        elif command == "media":
            self.contentLoader.openInMainFrame(location)
            self.customAdd(self.contentLoader)
        elif command == "internet":
            self.contentLoader.openBrowser()
            self.customAdd(self.contentLoader)
            self.contentLoader.text.grab_focus()
        elif command == "whiteboard":
            self.customAdd(self.whiteboard)
            self.hideToolbar()
        elif command == "settings":
            self.contentLoader.openNewWindow(self.rootAddr + location)
            self.customAdd(self.contentLoader)
        elif command == "keyboard":
            if self.keyboardActive == True:
                self.win.resize(self.xRes, self.yRes)
                self.keyboardActive = False
                self.keyboard.stop()
            else:
                self.win.resize(self.xRes, self.yRes - 225)
                self.keyboardActive = True
                self.keyboard = Keyboard()
                self.keyboard.start()
        elif command == "volumeup":
            self.contentLoader.volumeUp()
        elif command == "volumedown":
            self.contentLoader.volumeDown()

    def hideToolbar(self):
        self.toolbar.hide()

    def showToolbar(self):
        self.toolbar.show()

    def powerDown(self):
        dialog = gtk.MessageDialog(None, gtk.DIALOG_MODAL, gtk.MESSAGE_QUESTION, gtk.BUTTONS_YES_NO)
        dialog.set_modal(False)
        dialog.set_position(gtk.WIN_POS_CENTER)
#        dialog.set_markup("Has the IR pen been returned to its dock?")
        dialog.set_markup("Are you sure you'd like to shutdown?")
        dialog.show_all()
        response = dialog.run()
        dialog.destroy()
        if response == -9:
            return
        else:
            print "Powering Down"
            self.UI.active = False
            subprocess.call(['amixer', 'set', 'Master', '0dB'])
#            process = subprocess.Popen(['sudo', '-S', 'shutdown', '-P', 'now'], stdout=subprocess.PIPE, stdin=subprocess.PIPE, stderr=subprocess.PIPE)
#            process.communicate(self.password + "\n")
            sys.exit(0)

    #    Method to begin the application.
    def run(self):
        self.customAdd(self.contentLoader)
        if self.splashResponse == 1:
            self.initializeCalibration(None)
        elif self.splashResponse == 3:
            self.UI.restoreCalibration()
        self.win.show()
        self.toolbar.load()
#        Required command to start the GUI and wait for user input.
        gtk.main()

    def windowDestroyed(self, temp):
        print "Window Destroyed...exiting"
        self.UI.active = False
        subprocess.call(['amixer', 'set', 'Master', '0dB'])
        gtk.main_quit()



if __name__ == "__main__":
#    will sys.exit(-1) if other instance is running
    pid_file = 'program.pid'
    fp = open(pid_file, 'w')
    try:
        fcntl.lockf(fp, fcntl.LOCK_EX | fcntl.LOCK_NB)
    except IOError:
        print "another instance is running...exiting"
        self.UI.active = False
        sys.exit(0)

    controller = Controller()
    controller.run()
    
