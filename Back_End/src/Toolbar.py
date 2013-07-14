__author__="Peter Williams"
__date__ ="$Nov 5, 2011 5:16:42 PM$"

#import gtk
import webkit


class Toolbar(object):
    def __init__(self, rootAddr):
        self.address = rootAddr + "toolbar.html"
        self.topElement = self.buildBar()

    def buildBar(self):
#        Building
        bar = webkit.WebView()
#        bar.open(self.address)

#        Sizing
        bar.set_size_request(100, 100)


#        Packing


        return bar

#    def volumeUp(self, widget):
#        print "Increasing Volume"
#        subprocess.call(['amixer', 'set', 'Master', '2+'])
#
#    def volumeDown(self, widget):
#        print "Decreasing Volume"
#        subprocess.call(['amixer', 'set', 'Master', '2-'])

    def load(self):
        self.topElement.open(self.address)

    def show(self):
        self.topElement.show_all()

    def getWidget(self):
        return self.topElement

    def hide(self):
        self.topElement.hide()

    def getButtons(self):
        return [self.topElement]