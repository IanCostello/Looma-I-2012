import gtk
import sys
import poppler
import os
import cairo
import ConfigParser

import glob


class MyPDFViewer(object):
    def __init__(self, parent):
#        self.paths = self.findFiles(os.getcwd() + "/Resources/PDFs/")

        self.scale = None
        self.maxScale = None
        self.scaleInc = None
        self.dAreaSize = None

        self.vBoxMain = gtk.VBox()
        self.pageNum = 0
        self.dArea = None
        self.parent = parent
        self.homeButt = None
        self.bottomHBox = self.createBottomBox()

    def findFiles(self, path):
        files = []
        exts = ["*.pdf"] #Define which video formats to support
        for ext in exts:
            files += glob.glob(os.path.join(path, ext))
        return files

    def parseConfig(self):
        parser = ConfigParser.ConfigParser()
        parser.read('config.py')
        self.scale = parser.getfloat(self.config, 'scale')
        self.maxScale = parser.getfloat(self.config, 'maxScale')
        self.scaleInc = parser.getfloat(self.config, 'scaleInc')
        self.dAreaSize = (parser.getint(self.config, 'dAreaSizeX'), parser.getint(self.config, 'dAreaSizeY'))

    def createBottomBox(self):
        hBoxPage = gtk.HBox()
        hBoxPage.set_size_request(10, 75)

        nextPageButt = gtk.Button("Next &gt;&gt;&gt;")
        self.formatButton(nextPageButt)
        nextPageButt.connect("clicked", self.nextPage)
        nextPageButt.set_size_request(0, 75)

        prevPageButt = gtk.Button("&lt;&lt;&lt; Previous")
        self.formatButton(prevPageButt)
        prevPageButt.connect("clicked", self.prevPage)
        prevPageButt.set_size_request(0, 75)

#        self.homeButt = gtk.Button("EXIT")
#        self.formatButton(self.homeButt)
#        self.homeButt.set_size_request(150, 0)

        hBoxPage.pack_start(prevPageButt, True, True)
#        hBoxPage.pack_start(self.homeButt, False, True)
        hBoxPage.pack_start(nextPageButt, True, True)

        return hBoxPage

    def formatButton(self, button, size=25000, tColor="black", r=None, g=None, b=None):
        label = button.child
        label.set_markup("<span foreground=\"" + tColor + "\" size=\"" + str(size) + "\"><b>" + button.get_label() + "</b></span>")
        if r != None:
            button.modify_bg(gtk.STATE_NORMAL, gtk.gdk.Color(red=r, green=g, blue=b, pixel=0))
            button.modify_bg(gtk.STATE_PRELIGHT, gtk.gdk.Color(red=r, green=g, blue=b, pixel=0))

    def open(self, pdf, num=0):
        self.pageNum = num
        if pdf != 1:
            self.config = 'PDFViewer1'
        else:
            self.config = 'PDFViewer2'
#        self.path = "file://" + self.paths[pdf]
        self.path = pdf
        self.parseConfig()
#        self.createBottomBox()
        self.createViewer()
        self.document = poppler.document_new_from_file(self.path, None)
        self.numPages = self.document.get_n_pages()
        self.page = self.document.get_page(self.pageNum)
        self.surface = None
        self.createSurface()
        self.ctx = cairo.Context(self.surface)
        self.page.render(self.ctx)

#        self.packWindow()

    def createViewer(self):
#        Boxes
        vBoxZoom = gtk.VBox()
        hBoxMain = gtk.HBox()

        vBoxZoom.set_size_request(150, 10)

        sWin = gtk.ScrolledWindow()
        sWin.set_policy(gtk.POLICY_AUTOMATIC, gtk.POLICY_ALWAYS)
        self.dArea = gtk.DrawingArea()
        self.dArea.set_size_request(self.dAreaSize[0], self.dAreaSize[1])
        self.dArea.connect("expose-event", self.expose)


#   Buttons
#        zoomInButt = gtk.Button("+ Zoom In +")
        zoomInButt = gtk.Button("+")
#        self.formatButton(zoomInButt, 75000, "blue", 65535, 0, 13824)
        self.formatButton(zoomInButt, 75000, "blue", 52223, 50687, 53247)
        zoomInButt.connect("clicked", self.zoomIn)
        zoomInButt.set_size_request(75, 0)

#        zoomOutButt = gtk.Button("- Zoom Out -")
        zoomOutButt = gtk.Button("-")
#        self.formatButton(zoomOutButt, 75000, "red", 10752, 34815, 59391)
        self.formatButton(zoomOutButt, 75000, "red", 52223, 50687, 53247)
        zoomOutButt.connect("clicked", self.zoomOut)
        zoomOutButt.set_size_request(75, 0)


#   Packing
        vBoxZoom.pack_start(zoomInButt, True, True)
        vBoxZoom.pack_start(zoomOutButt, True, True)

        hBoxMain.pack_start(sWin, True, True)
        hBoxMain.pack_start(vBoxZoom, False, True)

        self.vBoxMain.pack_start(hBoxMain, True, True)
        self.vBoxMain.pack_start(self.bottomHBox, False, True)

        sWin.add_with_viewport(self.dArea)

        if self.vBoxMain.get_parent() == None:
            self.parent.add(self.vBoxMain)

    def refresh(self):
        self.vBoxMain.remove(self.bottomHBox)
        self.vBoxMain.destroy()
        self.createViewer()
        self.page = self.document.get_page(self.pageNum)
        self.surface = None
        self.createSurface()
        self.ctx = cairo.Context(self.surface)
        self.page.render(self.ctx)
        self.vBoxMain.show_all()

    def createSurface(self):
        self.surface = cairo.ImageSurface(cairo.FORMAT_ARGB32, 1400, 1050)

    def expose(self, dArea, event):
        self.ctx = dArea.window.cairo_create()
        self.ctx.scale(self.scale, self.scale)
        self.ctx.set_source_surface(self.surface, 0, 0)
        self.ctx.paint()

    def zoomIn(self, widget):
#        print ("zoom in")
        if self.scale < self.maxScale:
            self.scale += self.scaleInc
            self.refresh()

    def zoomOut(self, widget):
#        print ("zoom out")
        self.scale -= self.scaleInc
        self.refresh()

    def nextPage(self, widget):
#        print ("next page")
        if self.pageNum < self.numPages - 1:
            self.pageNum += 1
            self.refresh()

    def prevPage(self, widget):
#        print ("prev page")
        if self.pageNum != 0:
            self.pageNum -= 1
            self.refresh()

    def getButtons(self):
        return [self.homeButt]

    def getWidget(self):
        return self.vBoxMain

    def show(self):
        self.vBoxMain.show_all()

    def hide(self):
        self.pageNum = 0
        self.vBoxMain.remove(self.bottomHBox)
        self.vBoxMain.destroy()