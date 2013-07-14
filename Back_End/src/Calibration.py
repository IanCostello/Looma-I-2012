__author__="Peter"
__date__ ="$July 5, 2012 10:50:42 PM$"

import gtk
import os

#Class to handle the calibration screen for the IR sensor.
class Calibration(object):
    def __init__(self):
        print "Initializing Calibration..."
        self.path = os.getcwd() + "/Resources/Calibration/"
        self.images = self.createImages()
        self.currentImage = None
        self.topElement = self.createScreen()

    def createImages(self):
        im1=gtk.Image()
        im2=gtk.Image()
        im3=gtk.Image()
        im4=gtk.Image()
        im1.set_from_file(self.path + "calib1.png")
        im2.set_from_file(self.path + "calib2.png")
        im3.set_from_file(self.path + "calib3.png")
        im4.set_from_file(self.path + "calib4.png")
        return [im1, im2, im3, im4]

    def advanceImg(self, num):
        self.topElement.remove(self.currentImage)
        self.topElement.pack_start(self.images[num],True,True,0)
#        self.topElement.show_all()
        self.currentImage = self.images[num]
#        self.topElement.show_all()
        
    def createScreen(self):
#        Building
        vBox = gtk.VBox()
        
#        Sizing

#        Packing
        vBox.pack_start(self.images[0],True,True,0)

        self.currentImage = self.images[0]
        
        return vBox

    def reset(self):
        self.advanceImg(0)

    def getWidget(self):
        return self.topElement

    def show(self):
        self.topElement.show_all()

    def hide(self):
        self.topElement.hide()