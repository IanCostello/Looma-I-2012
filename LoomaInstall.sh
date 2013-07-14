#filename: LoomaInstall.sh
#purpose: Script to install all required packages for Looma and config some important features.
#       Also, this file will copy all of the code to the correct locations,
#       assuming that the latest versions of "Back_End" and "Front_End" are in the same working directory.

#new Version 4 version adds "apt-get gstreamer0.10-ffmeg" by Peter 11/24/2012
#new Version 4 version adds copy files to Desktop (logo, startup script, VERSIONx)

#Usage - sudo sh LoomaInstall.sh

echo "updating Ubuntu"
sudo apt-get update

echo "apt-get webkit, numpy, gstreamster, etc"
sudo apt-get install nautilus-open-terminal htop openoffice.org-writer python-webkit python-numpy gtk2-engines-pixbuf python-poppler apache2 libapache2-mod-php5 python-xlib gstreamer0.10-ffmpeg gstreamer0.10-fluendo-mp3

#echo "SUBSYSTEM==\"tty\", ATTRS{manufacturer}==\"Prolific Technology Inc.\", SYMLINK+=\"USBSerial\"" | sudo tee /etc/udev/rules.d/45.-my-devices.rules

sudo cp 45.-my-devices.rules /etc/udev/rules.d/

echo "export LIBOVERLAY_SCROLLBAR=0" | sudo tee /etc/X11/Xsession.d/80overlayscrollbars

echo "style \"scroll\"
{
    GtkScrollbar::slider-width = 30
}

class \"*\" style \"scroll\"" | sudo tee /.gtkrc-2.0

echo "copy Back_End"
sudo rm ~/Documents/Back_End -R
sudo cp Back_End ~/Documents -R
sudo chmod 777 ~/Documents/Back_End -R

echo "copy Front_End"
sudo rm /var/www/Front_End -R
sudo cp Front_End /var/www -R
sudo chmod 777 /var/www/Front_End -R

echo"copy Version"
sudo rm ~/Desktop/VERSION*
sudo cp VERSION* ~/Desktop

echo "copy startup script"
sudo rm ~/Desktop/LoomaStartup.sh
sudo cp LoomaStartup.sh ~/Desktop
sudo chmod 777 ~/Desktop/LoomaStartup.sh

echo "copy logo"
sudo rm ~/Pictures/LoomaLogo*
sudo cp LoomaLogo.png ~/Pictures

echo "copy sample mp3 file"
sudo rm ~/Music/sample*
sudo cp sample.mp3 ~/Pictures



sudo reboot

#sudo shutdown -h now
