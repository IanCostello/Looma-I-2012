#File: Controller.py
#Author: Peter Williams, Roja Nunna
#Class: ENGS89
#Date: Novemeber 6, 2011

__author__="group 18"
__date__ ="$Nov 6, 2011 11:53:23 AM$"

import gtk
import fcntl
import sys
import os
import string
#import dbus
#import gobject
import subprocess
import ConfigParser

#from WelcomeScreen import WelcomeScreen
from ContentLoader import ContentLoader
#from SelectionScreen import SelectionScreen
#from PlaybackInterface import PlaybackInterface
from Keyboard import Keyboard
from Whiteboard import Whiteboard
#from PhotoBooth import PhotoBooth
from Calibration import Calibration
from SerialReceiver import SerialReceiver
from MyPDFViewer import MyPDFViewer
#from ControlPanel import ControlPanel
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

        self.win = self.createWindow(self.xRes, self.yRes)
        self.win.show()

        self.UI = SerialReceiver(self)
#        begin mouse control
        self.UI.start()

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
#        self.bus = dbus.SystemBus()
#        self.hal_manager_obj = self.bus.get_object("org.freedesktop.Hal", "/org/freedesktop/Hal/Manager")
#        self.hal_manager = dbus.Interface(self.hal_manager_obj, "org.freedesktop.Hal.Manager")
#        self.hal_manager.connect_to_signal("DeviceAdded", self.filter)


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
#        self.frame.pack_start(self.controlPanel.getWidget(), False)
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
##        ControlPanel
#        lst = self.controlPanel.getButtons()
##        lst[0].connect("clicked", self.initializeCalibration)
##        lst[0].connect("clicked", self.initializePDFViewer)
##        lst[0].connect("clicked", self.webZoomIn)
#        lst[0].connect("clicked", self.convertToPDF)
#
#        lst[1].connect("clicked", self.powerDown)

#        ContentLoader
        lst = self.contentLoader.getButtons()
        lst[0].connect("navigation-policy-decision-requested", self.webNavRequested)
        lst[1].connect("navigation-policy-decision-requested", self.webNavRequested)

##        PDFViewer
#        lst = self.pdfViewer.getButtons()
#        lst[0].connect("clicked", self.exitPython)

#        Whiteboard
        lst = self.whiteboard.getButtons()
        lst[0].connect("clicked", self.saveWhiteboard)

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

#button label changes by SKIP 2012 11 12
        dialog.add_button("calibrate", 1)
        dialog.add_button("START", 2)
        dialog.add_button("default", 3)

        dialog.action_area.set_size_request(200, 200)
        dialog.action_area.set_layout(gtk.BUTTONBOX_SPREAD)

        children = dialog.action_area.get_children()
        for child in children:
            child.set_size_request(200, 200)
            label = child.child
            label.set_markup("<span foreground=\"black\" size=\"25000\"><b>" + child.get_label() + "</b></span>")

        dialog.show_all()

#        print title.get_allocation()

        response = dialog.run()
        dialog.destroy()
        return response

    def initializePDFViewer(self, pdf, num):
        self.pdfViewer.open(pdf, num)
        self.customAdd(self.pdfViewer)
#        self.controlPanel.hide()

#    def destroyPDFViewer(self, widget):
#        self.customAdd(self.lastScreen)
#        self.controlPanel.show()

    def exitPython(self, widget):
        self.customAdd(self.lastScreen)
#        self.controlPanel.show()

    def webNavRequested(self, view, frame, req, action, decision, data=None):
        url = req.get_uri()
        print url
        ind = string.find(url, "goto=")
        if ind != -1:
            command = url[ind+5:]
            print "Command Issued: " , command
            return self.webCommandIssued(command, url, ind)
        else:
#            if url[-4:] == ".pdf":
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
            return self.contentLoader.webCommandIssued(command, url, ind)
        return True

    def convertToPDF(self, widget):
#        file = self.path + "/Resources/impt.txt"
        file = self.path + "/Resources/power.ppt"
        subprocess.call(['oowriter', '-convert-to', 'pdf:writer_pdf_Export', '-outdir', self.path + "/Resources", file])
        subprocess.call(['rm', file])

    def saveWhiteboard(self, widget):
        self.whiteboard.saveCallback()

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

#    def toolbarCommandIssued(self, str, url, ind):
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
        elif command == "whiteboard":
            self.customAdd(self.whiteboard)
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




















################################################################################

    def buildControlPanel(self):
        hBox = gtk.HBox()
        recordButton = gtk.Button("Record")
        recordButton.child.set_markup("<span size=\"25000\"><b> Record </b></span>")
        recordButton.connect("clicked", self.recordCallback)
        stopButton = gtk.Button("Stop")
        stopButton.child.set_markup("<span size=\"25000\"><b> Stop </b></span>")
        stopButton.connect("clicked", lambda w: self.photoBooth.stopRecording())
#        displayOn = gtk.RadioButton(None, "Display On")
#        displayOn.child.set_markup("<span size=\"23000\"><b> Display On </b></span>")
#        displayOff = gtk.RadioButton(displayOn, "Display Off")
#        displayOff.child.set_markup("<span size=\"23000\"><b> Display Off </b></span>")
        self.calibrateButton = gtk.Button("Calibrate")
        self.calibrateButton.child.set_markup("<span size=\"25000\"><b> Calibrate </b></span>")
        self.calibrateButton.connect("clicked", self.initializeCalibration)
        mouseSpeedUp = gtk.Button("Faster Mouse")
        mouseSpeedUp.child.set_markup("<span size=\"25000\"><b> Faster\n Mouse </b></span>")
        mouseSpeedUp.connect("clicked", self.increaseMouseSpeed)
        mouseSpeedDown = gtk.Button("Slower Mouse")
        mouseSpeedDown.child.set_markup("<span size=\"25000\"><b> Slower\n Mouse </b></span>")
        mouseSpeedDown.connect("clicked", self.decreaseMouseSpeed)
        viewPDF = gtk.Button("View PDF")
        viewPDF.child.set_markup("<span size=\"25000\"><b> View\n  PDF </b></span>")
        viewPDF.connect("clicked", self.initializePDFViewer, 0)
        viewPDF1 = gtk.Button("View PDF1")
        viewPDF1.child.set_markup("<span size=\"25000\"><b> View\n  PDF1 </b></span>")
        viewPDF1.connect("clicked", self.initializePDFViewer, 1)
        powerDown = gtk.Button("Power-Off")
        powerDown.child.set_markup("<span size=\"25000\"><b> Power-Off </b></span>")
        powerDown.connect("clicked", self.powerDown)
        hBox.pack_start(recordButton)
        hBox.pack_start(stopButton)
#        hBox.pack_start(displayOn)
#        hBox.pack_start(displayOff)
        hBox.pack_start(self.calibrateButton)
        hBox.pack_start(mouseSpeedUp)
        hBox.pack_start(mouseSpeedDown)
        hBox.pack_start(viewPDF)
        hBox.pack_start(viewPDF1)
        hBox.pack_start(powerDown)
        hBox.show_all()
        hBox.set_size_request(1, 125)
        return hBox

    def configureWindowBox(self):
        wBox = self.windowBox
        self.windowBox.pack_start(self.controlPanel, False)
        triggerBox = gtk.EventBox()
        triggerBox.set_size_request(1, 1)
        triggerBox.connect("enter-notify-event", self.triggerCallback)
        wBox.pack_start(triggerBox, False)
        triggerBox.show()
        self.triggerBox = triggerBox
        wBox.show()
        self.win.add(wBox)

    def triggerCallback(self, widget, event):
#        print event
        if event != None:
            x, y, state = event.window.get_pointer()
        if self.controlPanelActive:
            self.controlPanel.hide()
            self.controlPanelActive = False
            self.triggerBox.set_size_request(1, 1)
        elif x < 200:
            self.controlPanel.show()
            self.controlPanelActive = True
            self.triggerBox.set_size_request(1, 30)

    def recordCallback(self, widget):
        if self.photoBooth.getCameraActivity():
            self.photoBooth.beginWriteSequence()
        else:
            self.photoBooth.run()

#    Adds an instance of 'Keyboard' to the content loader but does not display
#    it by default.
    def addKeyboard(self):
        self.contentLoader.addKeyboard(self.keyboard.getKeyboard())
        self.keyboard.hide()
        self.whiteboard.addKeyboard(self.newKeyboard.getKeyboard())
        self.newKeyboard.hide()

#    Adds callbacks to the 'WelcomeScreen'.
    def addWelcomeCallbacks(self):
        self.welcomeScreen.loadButton.connect("clicked", self.loadButtonClicked)
        self.welcomeScreen.playButton.connect("clicked", self.playButtonClicked)
        self.welcomeScreen.whiteBoardButton.connect("clicked",self.whiteBoardButtonClicked)
#        self.welcomeScreen.oleButton.connect("clicked", self.loadButtonClicked, "file://" + self.currentDir + "/../../Pustakalaya/index.html")
        self.welcomeScreen.oleButton.connect("clicked", self.loadButtonClicked, "http://www.pustakalaya.org")
        
#    Adds callbacks to the 'ContentLoader'.
    def addContentLCallbacks(self):
        homeButton = self.contentLoader.getHomeButton()
        homeButton.connect("clicked", self.showWelcomeScreen)
        playContentButton=self.contentLoader.getPlayContentButton()
        playContentButton.connect("clicked",self.playButtonClicked)
        whiteboardButton=self.contentLoader.getWhiteboardButton()
        whiteboardButton.connect("clicked",self.whiteBoardButtonClicked)
        
    def addWhiteboardCallbacks(self):
        homeButton = self.whiteboard.getHomeButton()
        homeButton.connect("clicked", self.showWelcomeScreen)
        playContentButton=self.whiteboard.getPlayContentButton()
        playContentButton.connect("clicked",self.playButtonClicked)
        loadContentButton=self.whiteboard.getLoadContentButton()
        loadContentButton.connect("clicked",self.loadButtonClicked)
#        self.whiteboard.getSaveButton().connect("clicked", self.newKeyboardInitClicked, self.newKeyboard)
        

#    Adds a keyboard inititializer button to the 'ContentLoader'.
    def addKeyboardInitCallback(self):
        self.contentLoader.getKeyboardButton().connect("clicked", self.keyboardInitClicked, self.keyboard)

    def addNewKeyboardInitCallback(self):
        self.whiteboard.getSaveButton().connect("clicked", self.newKeyboardInitClicked, self.newKeyboard)

#    Adds callbacks to the 'SelectionScreen'.
    def addSelectionCallbacks(self):
#        Adds a generic callback to each button.  Distinguishing between buttons
#        is handled in the 'videoButtonClicked' method.
        for button in self.selectionScreen.getButtons():
            button.connect("clicked", self.videoButtonClicked)
        self.selectionScreen.getHomeButton().connect("clicked", self.showWelcomeScreen)
        self.selectionScreen.getLoadContentButton().connect("clicked",self.loadButtonClicked)
        self.selectionScreen.getMasterDeleteButton().connect("clicked", self.masterDelete)
        self.selectionScreen.getCopyButton().connect("clicked", self.copy)
        self.selectionScreen.getWhiteboardButton().connect("clicked", self.whiteBoardButtonClicked)
#        whiteboardButton.connect("clicked",self.whiteBoardButtonClicked)

#    Adds callbacks to the 'Keyboard'.
    def addKeyboardCallbacks(self, keyboard):
        buttons, controlButtons = keyboard.getButtons()
#        Adds a generic callback to each button.  Distinguishing between buttons
#        is handled in the 'keyboardButtonClicked' method.
        for button in buttons:
            button.connect("clicked", self.keyboardButtonClicked)
        for controlButton in controlButtons:
            controlButton.connect("clicked", self.keyboardButtonClicked)

#    Handles 'loadButton' clicks.
    def loadButtonClicked(self, widget, address=None):
        print "Load Button Clicked"
        self.initializeContentLoader(address)

#    Handles 'playButton' clicks.
    def playButtonClicked(self, widget):
        print "Play Button Clicked"
        self.initializeSelectionScreen()

#    def whiteBoardButtonClicked(self,widget):
#        print "Whiteboard button Clicked"
##        paint = Paint()
#        tempScreen = self.currentScreen
#        whiteboard = Whiteboard(self.keyboard)
#        self.currentScreen = whiteboard
#        whiteboard.run()
#        self.currentScreen = tempScreen

#    Handles 'videoButton' clicks.
    def videoButtonClicked(self, widget):
        if self.selectionScreen.getEditableState():
            self.selectionScreen.swapButtonState(widget)
        else:
            path = self.selectionScreen.getPath() + widget.get_label()
            self.initializePlayer(path)

#    Toggle the onscreen 'Keyboard'.
    def keyboardInitClicked(self, widget, keyboard):
        if self.keyboardActive:
            print "Removing Keyboard"
            keyboard.hide()
            self.keyboardActive = False
        else:
            keyboard.show()
            self.keyboardActive = True
#            if keyboard == self.newKeyboard:
#                self.whiteboard.saveCallback()

    def newKeyboardInitClicked(self, widget, keyboard):
#        self.newKeyboard.show()
        print "Calling the Save Callback"
        self.whiteboard.saveCallback()
        self.newKeyboard.hide()

#    Handles 'Keyboard' clicks.
    def keyboardButtonClicked(self, widget):
        char = widget.get_label()
        self.currentScreen.enterText(char)

    def masterDelete(self, widget):
        if self.selectionScreen.delete():
            self.addSelectionCallbacks()

    def copy(self, widget):
        if self.selectionScreen.copySelected():
            self.addSelectionCallbacks()

#    Initializes the 'ContentLoader'.
    def initializeContentLoader(self, address=None):
#        self.win.remove(self.currentWidget)
        self.windowBox.remove(self.currentWidget)
        print "Adding the Content Loader"
        self.contentLoader.getDownloadProgressBox().hide()
        self.customAdd(self.contentLoader.getWidget(), self.contentLoader)
        self.contentLoader.showContentLoader()
        self.keyboard.hide()
        self.keyboardActive = False
        if address != None:
            self.contentLoader.loadContent(address)
#        Size of the WebView (need to open cL twice)
#        print self.contentLoader.web.get_allocation()

#    Initializes the 'SelectionScreen'.
    def initializeSelectionScreen(self):
        print "Removing the welcome screen"
#        self.win.remove(self.currentWidget)
        self.windowBox.remove(self.currentWidget)
        print "Adding the Content Loader"
        self.selectionScreen = SelectionScreen()
        self.addSelectionCallbacks()
        self.customAdd(self.selectionScreen.getWidget(), self.selectionScreen)

#    def destroyPDFViewer(self, widget):
#        self.pdfViewer.getWidget().destroy()
#        self.showWelcomeScreen(None)

    def whiteBoardButtonClicked(self, widget):
#        self.whiteboard = Whiteboard()
#        self.win.remove(self.currentWidget)
        self.windowBox.remove(self.currentWidget)
        self.customAdd(self.contentLoader.getWidget(), self.contentLoader)
#        self.win.remove(self.currentWidget)
        self.windowBox.remove(self.currentWidget)
        self.customAdd(self.whiteboard.getWidget(), self.whiteboard)
        self.whiteboard.penDown = False
        self.whiteboard.pen = 1
#        self.addWhiteboardCallbacks()

#    Initializes the 'Player'.
    def initializePlayer(self, path):
        if path[-3:]=="avi":
            PlaybackInterface(path)
        else:
            print "Opening Image"
	    win=gtk.Window()
	    win.fullscreen()
            vbox=gtk.VBox()
	    im=gtk.Image()
	    im.set_from_file(path)
            button=gtk.Button("Close")
            button.connect("clicked", lambda w: win.destroy())
            vbox.pack_start(button,False,False,0)
            vbox.pack_start(im,True,True,0)
            vbox.show_all()
	    win.add(vbox)
	    win.show_all()

#    Returns to the 'WelcomeScreen'.
    def showWelcomeScreen(self, widget):
#        self.win.remove(self.currentWidget)
        self.windowBox.remove(self.currentWidget)
        self.customAdd(self.welcomeScreen.getWidget(), self.welcomeScreen)

    def increaseMouseSpeed(self, widget):
        self.UI.xAccel += .5
        self.UI.yAccel += .5

    def decreaseMouseSpeed(self, widget):
        self.UI.xAccel -= .5
        self.UI.yAccel -= .5





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
#            self.customAdd(self.contentLoader)
            self.initializeCalibration(None)
        elif self.splashResponse == 3:
            self.UI.restoreCalibration()
#            self.customAdd(self.contentLoader)
#            self.customAdd(self.contentLoader)
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
    
