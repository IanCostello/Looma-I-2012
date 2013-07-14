__author__="Peter"
__date__ ="$Nov 5, 2011 5:16:42 PM$"

import webkit
import gtk
#import gobject
import subprocess
import os
import string

#Class that handles the web interface and content downloading
class ContentLoader(object):
    def __init__(self, rootAddr):
        print "Initializing ContentLoader..."
        self.currDir = os.getcwd()
        self.rootAddr = rootAddr
#        self.address = rootAddr + "mainFrame.html"
#        self.address = rootAddr + "toolbar.html"
        self.address = "file://" + rootAddr + "home.html"
        self.homePage = "http://www.google.com"
#        self.address = "file://" + self.currDir + "/Resources/settings.html"
        
        self.downloadProgressBox=None
        self.web = None
        self.sWeb = None
        self.addressBar = None
        self.backNForward = None

        self.dialogActive = False
        self.downloadComplete = False
        self.percent = None
        self.firstRun = True
        self.topElement = self.createWebView()
        self.addDownloadCallback()

        self.currentWeb = self.web.get_parent().get_parent()
        self.backgroundWeb = self.sWeb.get_parent()
        self.addressActive = False
        self.bNFActive = True

    def createWebView(self):
#        Building
        hBox = gtk.HBox()
        vbox=gtk.VBox()
        scroller = gtk.ScrolledWindow()
#        scroller.set_policy(gtk.POLICY_AUTOMATIC, gtk.POLICY_ALWAYS)

        self.web = webkit.WebView()
        self.web.connect("load-progress-changed", self.loadProgressChanged)
        self.web.connect("new-window-policy-decision-requested", self.suppressNewWindow)

        self.addressBar=gtk.HBox()
        hBoxDownload=gtk.HBox()
        self.text = gtk.Entry()
        self.entry = gtk.Entry()
        self.progress=gtk.ProgressBar()
        self.downloadProgressBox = gtk.Label()

        go = gtk.Button("GO")
        label = go.child
        label.set_markup("<span foreground=\"blue\" size=\"20000\"><b>" + go.get_label() + "</b></span>")
        go.connect("clicked", self.goclicked)

        refresh=gtk.ToolButton(gtk.STOCK_REFRESH)
        refresh.connect("clicked",self.refreshClicked)

        home = gtk.ToolButton(gtk.STOCK_HOME)
        home.connect("clicked", self.homeClicked)

        back = gtk.ToolButton(gtk.STOCK_GO_BACK)
        back.connect("clicked", self.goBack)

        forward = gtk.ToolButton(gtk.STOCK_GO_FORWARD)
        forward.connect("clicked", self.goForward)
        
        self.backNForward = gtk.HBox()
        
        back1 = gtk.ToolButton(gtk.STOCK_GO_BACK)
        back1.connect("clicked", self.goBack)

        forward1 = gtk.ToolButton(gtk.STOCK_GO_FORWARD)
        forward1.connect("clicked", self.goForward)

#        Sizing
        self.text.set_size_request(150,40)
        go.set_size_request(150,40)
        refresh.set_size_request(150,40)
        home.set_size_request(150,40)
        back.set_size_request(150,40)
        forward.set_size_request(150,40)

        self.backNForward.set_size_request(40, 40)

#        Packing
        self.addressBar.pack_start(self.text)
        self.addressBar.pack_start(go,False)
        self.addressBar.pack_start(refresh,False)
        self.addressBar.pack_start(back, False)
        self.addressBar.pack_start(forward, False)
        self.addressBar.pack_start(home, False)
        
        self.backNForward.pack_start(back1)
        self.backNForward.pack_start(forward1)


        hBoxDownload.pack_end(self.downloadProgressBox)

        scroller.add(self.web)

        vbox.pack_start(self.addressBar,False)
        vbox.pack_start(self.backNForward,False)
        vbox.pack_start(scroller)
        vbox.pack_start(hBoxDownload,False)
        
        hBox.pack_start(vbox)
        hBox.pack_start(self.createSecondary())

        return hBox

    def createSecondary(self):
        scroller = gtk.ScrolledWindow()
        self.sWeb = webkit.WebView()
#        self.sWeb.connect("navigation-policy-decision-requested", self.sWinNavigating)

        self.sWeb.set_size_request(200, 200) #This should really be bigger, but it seems to fix the problem of overriding the 'Toolbar'

        scroller.add(self.sWeb)

#        return self.sWeb
        return scroller

    def openNewWindow(self, url):
        self.sWeb.open(url)
        self.showSWeb()

    def suppressNewWindow(self, view, frame, req, action, decision, data=None):
        url = req.get_uri()
        print "Suppressing New Window"
        self.web.open(url)

    def sWinNavigating(self, view, frame, req, action, decision, data=None):
        url = req.get_uri()
        print "sWin: " + url
        ind = string.find(url, "goto=")
        if ind != -1:
            command = url[ind+5:]
            print "sWin Command Issued: " , command
            self.webCommandIssued(command, url, ind)
            return True
        else:
            return False

    def swapWindow(self):
        self.currentWeb.hide()
        self.backgroundWeb.show()
        tempWeb = self.currentWeb
        self.currentWeb = self.backgroundWeb
        self.backgroundWeb = tempWeb

    def webCommandIssued(self, command, url, ind):
        if command == "close":
            self.swapWindow()
            return True
        elif command == "newtab":
            self.openNewWindow(url[0:ind-1])
            return True
        elif command == "zoomin":
            self.zoomIn()
        elif command == "zoomout":
            self.zoomOut()
        elif command == "volumeup":
            self.volumeUp()
        elif command == "volumedown":
            self.volumeDown()
        return False
    
    def zoomIn(self):
        self.web.zoom_in()
        self.sWeb.zoom_in()

    def zoomOut(self):
        self.web.zoom_out()
        self.sWeb.zoom_out()

    def volumeUp(self):
        print "Increasing Volume"
        subprocess.call(['amixer', 'set', 'Master', '2+'])

    def volumeDown(self):
        print "Decreasing Volume"
        subprocess.call(['amixer', 'set', 'Master', '2-'])

#    def sWinOpen(self, addr):
#        self.sWeb.open(addr)

    def openInMainFrame(self, file):
        self.web.open(self.rootAddr + file)
        self.addressActive = False
        self.bNFActive = True
        self.showWeb()

    def openBrowser(self):
        self.web.open(self.homePage)
        self.addressActive = True
        self.bNFActive = False
        self.showWeb()

    def hideAddressBar(self):
        self.addressBar.hide()

    def showAddressBar(self):
        self.addressBar.show_all()

    def loadProgressChanged(self, widget, amount):
        self.progress.set_fraction(amount/100.0)

    def goclicked(self, widget = None):
        text = self.parseAddress(self.text.get_text())
        self.web.open(text)

    def parseAddress(self, addr):
        if addr == "":
#            return self.address
            return self.homePage
        header = addr[0:11]
        if header != "http://www.":
            if header[0:4] == "www.":
                addr = "http://" + addr
            else:
                addr = "http://www." + addr
        return addr

    def homeClicked(self, widget):
        self.web.open(self.homePage)

    def showWeb(self):
        self.currentWeb = self.sWeb.get_parent()
        self.backgroundWeb = self.web.get_parent().get_parent()
        self.swapWindow()

    def showSWeb(self):
        self.currentWeb = self.web.get_parent().get_parent()
        self.backgroundWeb = self.sWeb.get_parent()
        self.swapWindow()

    def addDownloadCallback(self):
        self.web.connect("download-requested", self.onDownload)
        
    def onDownload(self, widget, download):
        self.downloadProgressBox.show()
        self.downloadProgressBox.set_text("Download in Progress...")
        filename = self.dialog(download.get_suggested_filename())
        if filename == "":
            self.downloadProgressBox.set_text("Download Canceled")
            return
        needsExt = True
        for char in filename:
            if char == ".":
                needsExt = False
                pass
        if needsExt:
            filename = filename + ".avi"

        download.set_destination_uri("file://" + self.currDir + "/Resources/Downloads/" + filename)
        print "Downloading from: " , download.get_uri()
        print "filename: ", download.get_suggested_filename()
        print "Size = ", str(download.get_total_size())
        print "Destination: ", download.get_destination_uri()
        download.start()

        response = subprocess.call("wget " + download.get_uri() + " -O \"" + self.currDir + "/Resources/Downloads/" + filename + "\"", shell = True)
        if response == 0:
            self.downloadProgressBox.set_text("Download Complete!")
        else:
            self.downloadProgressBox.set_text("Download Failed!")

    def dialog(self, filename):
        self.dialogActive = True
        dialog = gtk.MessageDialog(None, gtk.DIALOG_MODAL, gtk.MESSAGE_QUESTION, gtk.BUTTONS_OK_CANCEL)
        dialog.set_markup("Please choose a filename")
        for i in range(len(filename)):
            if filename[i] == ".":
                ext = filename[i:]
                ind = i
                pass
        self.entry.set_text(filename[0:ind])
        self.entry.connect("activate", self.responseToDialog, dialog, gtk.RESPONSE_OK)
        dialog.vbox.pack_start(self.entry, False, 5, 5)
        dialog.show_all()
        response = dialog.run()
        fName = self.entry.get_text()
        dialog.destroy()
        self.dialogActive = False
        if response == -5:
            return fName + ext
        else:
            return ""

    def responseToDialog(entry, dialog, response):
        dialog.response(response)


    def enterText(self, text):
        if self.dialogActive:
            widget = self.entry
        else:
            widget = self.text
        curr = widget.get_text()
        if text == "Backspace":
            widget.set_text(widget.get_text()[0:-1])
            return
        elif text == "Space":
            text = " "
        elif text == "Enter":
            self.goclicked()
            return
        widget.set_text(curr + text)

    def refreshClicked(self, widget):
        self.web.reload()

    def goBack(self, widget):
        self.web.go_back()

    def goForward(self, widget):
        self.web.go_forward()

    def loadContent(self, address=None):
        if address == None:
            address = self.address
        self.web.open(address)

    def getWidget(self):
        return self.topElement
        
    def hide(self):
        self.topElement.hide()

    def show(self):
        self.topElement.show_all()
#        self.sWeb.hide()
        if self.addressActive == False:
            self.hideAddressBar()
        if self.bNFActive == False:
            self.backNForward.hide()
        self.backgroundWeb.hide()
        if self.firstRun:
            self.loadContent()
            self.firstRun = False

    def getHomeButton(self):
        return self.homeButton

    def getPlayContentButton(self):
        return self.playContentButton

    def getWhiteboardButton(self):
        return self.whiteboardButton

    def getKeyboardButton(self):
        return self.keyboardButton

    def getTextWidget(self):
        return self.text

    def getDownloadProgressBox(self):
        return self.downloadProgressBox

    def addKeyboard(self, keyboard):
        self.vBox.pack_start(keyboard, False)
#        keyboard.set_size_request(200, 200)
        self.vBox.reorder_child(keyboard, 2)

    def getButtons(self):
        return [self.web, self.sWeb]