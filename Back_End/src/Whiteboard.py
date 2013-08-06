import gtk
import os

#2013 version with QUIT button

class Whiteboard(object):
    def __init__(self, rootAddr):

        self.pixmap = None
        self.x_old = None
        self.y_old = None
        self.pen = 1
        self.drawing_area = None
        self.gc = None
        self.color = gtk.gdk.Color(0, 0, 0)
        self.entry = None
        self.homeButton = None
        self.playContentButton = None
        self.loadContentButton = None
        self.whiteboardButton = None
        self.saveButton = None
        self.quitButton = None
        self.penDown = False
        self.keyboard = None

        self.rootAddr = rootAddr


#        self.hBottomBox = self.makeBottomBox()
        self.topElement = self.createVbox()
        
        
        

    def createVbox(self):
#        window = gtk.Window(gtk.WINDOW_TOPLEVEL)
#        window.set_name ("Test Input")
##        window.set_size_request(800,500)
#        window.fullscreen()

        vbox = gtk.VBox()
#        vbox = gtk.VBox(False, 0)
#        window.add(vbox)
#        vbox.show()

#        window.connect("destroy", lambda w: gtk.main_quit())

        # Create the drawing area
        self.drawing_area = gtk.DrawingArea()
#        self.drawing_area.modify_fg(gtk.STATE_NORMAL, gtk.gdk.Color(red=0 ,blue=0, green = 0))
        self.drawing_area.set_size_request(200, 200)
#        self.style.xthickness = 0
#        self.style.ythickness = 0
#        vbox.pack_start(self.drawing_area, True, True, 0)

        # Signals used to handle backing pixmap
        self.drawing_area.connect("expose_event", self.expose_event)
        self.drawing_area.connect("configure_event", self.configure_event)

        # Event signals
        self.drawing_area.connect("motion_notify_event", self.motion_notify_event)
        self.drawing_area.connect("button_press_event", self.button_press_event)
        self.drawing_area.connect("button_release_event", self.button_release_event)

        self.drawing_area.set_events(gtk.gdk.EXPOSURE_MASK
                                | gtk.gdk.LEAVE_NOTIFY_MASK
                                | gtk.gdk.BUTTON_PRESS_MASK
                                | gtk.gdk.BUTTON_RELEASE_MASK
                                | gtk.gdk.POINTER_MOTION_MASK
                                | gtk.gdk.POINTER_MOTION_HINT_MASK)

        self.saveButton=gtk.Button("Save")
#        self.saveButton.connect("clicked", self.saveCallback)
        self.saveButton.set_size_request(75, 75)

        self.quitButton = gtk.Button("Quit")
        self.quitButton.set_size_request(75, 75)

#        vbox.pack_start(button, False, False, 0)

        #add toggle button and eraser tools
        vboxSide=gtk.VBox()
        eraserButton=gtk.Button("Eraser")
        eraserButton.connect("clicked", self.eraserCallback)
        eraserButton.set_size_request(75, 75)
        penButton=gtk.Button("Pen")
        penButton.connect("clicked", self.penCallback)
        penButton.set_size_request(75, 75)
        clearButton = gtk.Button("Clear")
        clearButton.connect("clicked", self.clearCallback)
        clearButton.set_size_request(75, 75)
        blackPen=gtk.RadioButton(None, "Black")
        blackPen.set_size_request(75, 75)
        blackPen.connect("toggled", self.callback, "blackPen")
        greenPen=gtk.RadioButton(blackPen, "Green")
        greenPen.set_size_request(75, 75)
        greenPen.connect("toggled", self.callback, "greenPen")
        redPen=gtk.RadioButton(greenPen, "Red")
        redPen.set_size_request(75, 75)
        redPen.connect("toggled", self.callback, "redPen")
        bluePen=gtk.RadioButton(redPen, "Blue")
        bluePen.set_size_request(75, 75)
        bluePen.connect("toggled", self.callback, "bluePen")
        vboxSide.pack_start(penButton, False)
        vboxSide.pack_start(eraserButton, False)
        vboxSide.pack_start(clearButton, False)
        vboxSide.pack_start(blackPen, False)
        vboxSide.pack_start(greenPen, False)
        vboxSide.pack_start(redPen, False)
        vboxSide.pack_start(bluePen, False)
        vboxSide.pack_start(self.saveButton,False)
        vboxSide.pack_start(self.quitButton,False)
        
        hboxCenter = gtk.HBox()
        hboxCenter.pack_start(vboxSide,False)
        hboxCenter.pack_start(self.drawing_area,True,True,0)

#        hboxBottom = gtk.HBox()
#        hboxBottom.pack_start(saveButton,True)
#        hboxBottom.pack_start(quitButton,True)

        vbox.pack_start(hboxCenter)
#        self.keyboard.getKeyboard().reparent(vbox)
#        vbox.pack_start(self.keyboard.getKeyboard())

#        vbox.pack_start(self.hBottomBox, False)

#        self.keyboard.getKeyboard().reparent(vbox)
#        vbox.pack_start()

#        vbox.pack_start(hboxBottom, False)
#        vbox.show_all()
#        self.keyboard.hide()
        return vbox

    def makeBottomBox(self):
        homeImage = gtk.Image()
        homeImage.set_from_file("Resources/PanelImages/yak.png")
        self.homeButton=gtk.Button()
        self.homeButton.add(homeImage)
        self.homeButton.set_size_request(75,80)
        self.homeButton.set_tooltip_text("Home Page")

        loadContentImage = gtk.Image()
        loadContentImage.set_from_file("Resources/PanelImages/earthdownload.png")
        self.loadContentButton=gtk.Button()
        self.loadContentButton.add(loadContentImage)
        self.loadContentButton.set_size_request(75,80)
        self.loadContentButton.set_tooltip_text("Download content")

        playContentImage = gtk.Image()
        playContentImage.set_from_file("Resources/PanelImages/player.png")
        self.playContentButton=gtk.Button()
        self.playContentButton.add(playContentImage)
        self.playContentButton.set_size_request(75,80)
        self.playContentButton.set_tooltip_text("Play Videos")

        whiteboardImage = gtk.Image()
        whiteboardImage.set_from_file("Resources/PanelImages/whiteboard.png")
        self.whiteboardButton=gtk.Button()
        self.whiteboardButton.add(whiteboardImage)
        self.whiteboardButton.set_size_request(75,80)
        self.whiteboardButton.set_tooltip_text("Open a Whiteboard")

        hbox=gtk.HBox()
        hbox.pack_start(self.homeButton,False)
        hbox.pack_start(self.loadContentButton,False)
        hbox.pack_start(self.playContentButton,False)
        hbox.pack_start(self.whiteboardButton,False)

        return hbox

    def eraserCallback(self, widget):
        self.pen = 0

    def penCallback(self, widget):
        self.pen = 1

    def clearCallback(self, widget):
        alloc = self.drawing_area.get_allocation()
        width, height = alloc.width, alloc.height
        self.pixmap.draw_rectangle(self.drawing_area.get_style().white_gc, True, 0, 0, width, height)
        self.drawing_area.queue_draw()

    def callback(self, widget, data=None):
#        print "%s was toggled %s" % (data, ("OFF", "ON")[widget.get_active()])
        if data == "blackPen":
            self.color = gtk.gdk.Color(0, 0, 0)
        elif data == "redPen":
            self.color = gtk.gdk.Color(65535, 0, 0)
        elif data == "bluePen":
            self.color = gtk.gdk.Color(0, 0, 65535)
        else:
            self.color = gtk.gdk.Color(0, 65535, 0)
        self.gc.set_rgb_fg_color(self.color)

    def saveCallback(self):
        alloc = self.drawing_area.get_allocation()
        width, height = alloc.width, alloc.height
        pixbuf = gtk.gdk.Pixbuf (gtk.gdk.COLORSPACE_RGB, 0, 8, width, height)
        pixbuf.get_from_drawable (self.pixmap, self.drawing_area.get_colormap() ,0, 0, 0, 0, width, height)
#        self.keyboard.show()
        filename=self.dialog()
        if filename == "":
            return
#        filePath = self.rootAddr + "/Resources/Whiteboard/" + filename + ".png"
        filePath = self.rootAddr + "/Resources/Documents/WhiteBoardFiles/" + filename + ".png"
        print filename + ".png Saved"
        pixbuf.save (filePath, "png")

    def dialog(self):
        print "Dialog Called"
#        self.keyboard.show()
        dialog = gtk.MessageDialog(None, gtk.DIALOG_MODAL, gtk.MESSAGE_QUESTION, gtk.BUTTONS_OK_CANCEL)
        dialog.set_modal(False)
        dialog.set_position(gtk.WIN_POS_CENTER)
        x, y = dialog.get_position()
        dialog.move(x, 0)
        dialog.set_markup("Please choose a filename")
        self.entry=gtk.Entry()
#        self.entry.connect("activate", self.responseToDialog, dialog, gtk.RESPONSE_OK)
        dialog.vbox.pack_start(self.entry, False, 5, 5)
        dialog.show_all()
        response = dialog.run()
        fName = self.entry.get_text()
        dialog.destroy()
        if response == -5:
            return fName
        else:
            return ""

#    def responseToDialog(self, entry, dialog, response):
#        dialog.response(response)

    # Create a new backing pixmap of the appropriate size
    def configure_event(self, widget, event):
        x, y, width, height = widget.get_allocation()
        self.pixmap = gtk.gdk.Pixmap(widget.window, width, height)
        self.pixmap.draw_rectangle(widget.get_style().white_gc, True, 0, 0, width, height)
        return True

    # Redraw the screen from the backing pixmap
    def expose_event(self, widget, event):
        x , y, width, height = event.area
        widget.window.draw_drawable(widget.get_style().fg_gc[gtk.STATE_NORMAL],
                                    self.pixmap, x, y, x, y, width, height)
        self.gc = widget.window.new_gc()
        self.gc.line_width = 3
        self.gc.set_rgb_fg_color(self.color)
        return False

    def draw_brush(self, widget, x, y):
        if self.penDown == False:
            return
        param = 125
        x = int(x)
        y = int(y)
        if self.pen == 1:
            self.pixmap.draw_line(self.gc, self.x_old, self.y_old, x, y)
            if x<=75 or y<=75:
                widget.queue_draw()
            else:
#                widget.queue_draw_area(self.x_old, self.y_old, x+1, y+1)
                widget.queue_draw_area(x-param, y-param, x+param, y+param)
#                widget.queue_draw_area(x-75, y-75, x+75, y+75)
#                widget.queue_draw()
            self.x_old = x
            self.y_old = y

    def erase(self, widget, x, y):
        rect = (int(x-30), int(y-30), 60, 60)
        self.pixmap.draw_rectangle(widget.get_style().white_gc, True,
                              rect[0], rect[1], rect[2], rect[3])
        widget.queue_draw_area(rect[0], rect[1], rect[2]+1, rect[3]+1)


    def button_press_event(self, widget, event):
        if event.button == 1 and self.pixmap != None:
            self.penDown = True
            self.x_old = int(event.x)
            self.y_old = int(event.y)
            if self.pen==1:
                self.draw_brush(widget, event.x, event.y)
            else:
                self.erase(widget, event.x, event.y)
        return True

    def button_release_event(self, widget, event):
        if event.button == 1 and self.pixmap != None:
            self.penDown = False
            self.x_old = None
            self.y_old = None


    def motion_notify_event(self, widget, event):
        if event.is_hint:
            x, y, state = event.window.get_pointer()
        else:
            x = event.x
            y = event.y
            state = event.state

#        if state & gtk.gdk.BUTTON1_MASK and self.pixmap != None:
        if gtk.gdk.BUTTON1_MASK and self.pixmap != None:
            if self.pen==1:
                if self.x_old == None:
                    self.x_old = int(event.x)
                    self.y_old = int(event.y)
                self.draw_brush(widget, x, y)
            else:
                self.erase(widget, x, y)

        return True

    def enterText(self, text):
        widget = self.entry
        curr = widget.get_text()
        if text == "Backspace":
            widget.set_text(widget.get_text()[0:-1])
            return
        elif text == "Space":
            text = " "
        elif text == "Enter":
            return
        widget.set_text(curr + text)

    def addKeyboard(self, keyboard):
        self.keyboard = keyboard
        self.vbox.pack_start(keyboard, False)
        self.vbox.reorder_child(keyboard, 1)

    def hide(self):
        self.topElement.hide()
        
    def show(self):
        self.topElement.show_all()

    def getWidget(self):
        return self.topElement

    def getButtons(self):
        return [self.saveButton, self.quitButton]
