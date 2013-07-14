__author__="peter"
__date__ ="$Jun 29, 2012 3:38:00 PM$"

import subprocess
import threading

class Keyboard(threading.Thread):
    def __init__(self):
        threading.Thread.__init__(self)
        print "Initializing Keyboard..."

    def run(self):
        subprocess.call(['onboard'])

    def stop(self):
        subprocess.call(['killall', 'onboard'])