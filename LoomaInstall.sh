#filename: LoomaInstall.sh
#purpose: Script to install all required packages for Looma and config some important features.
#       Also, this file will copy all of the code to the correct locations,
#       assuming that the latest versions of "Back_End" and "Front_End" are in the same working directory.

#new Version 4 version adds "apt-get gstreamer0.10-ffmeg" by Peter 11/24/2012
#new Version 4 version adds copy files to Desktop (logo, startup script, VERSIONx)
#new Version 5 cleanup Ubuntu and remove unnecessary apps by Nabin 2013 07 25 

#Usage - sudo sh LoomaInstall.sh

#
# note: looma pandaboard comes up as "armv7l"
PLATFORM=`uname -p`


# Let's remove packages from Ubuntu that we do not need 

# removing libre-office
# libwebkitgtk needs this for some reason, so it gets re-installed if not found 
sudo apt-get remove libreoffice-base-core libreoffice-calc libreoffice-common libreoffice-core libreoffice-draw libreoffice-emailmerge libreoffice-gnome libreoffice-gtk libreoffice-help-en-us libreoffice-impress libreoffice-math libreoffice-style-human libreoffice-style-tango libreoffice-writer

# removing twitter client
sudo apt-get remove gwibber gwibber-service gwibber-service-facebook gwibber-service-identica gwibber-service-twitter libgwibber-gtk2 libgwibber2
if [ "$?" -ne 0 ]; then 
	echo "Failed on gwibber removal "
	exit 2
fi

# removing thunderbird 
sudo apt-get remove thunderbird thunderbird-globalmenu thunderbird-gnome-support thunderbird-locale-en thunderbird-locale-en-us
if [ "$?" -ne 0 ]; then 
	echo "Failed on thunderbird removal "
	exit 2
fi

# removing games 
sudo apt-get remove aisleriot mahjongg
if [ "$?" -ne 0 ]; then 
	echo "Failed on games removal "
	exit 2
fi

# removing rhythmbox -- iTunes clone 
sudo apt-get remove rhythmbox rhythmbox-data rhythmbox-mozilla rhythmbox-plugin-cdrecorder rhythmbox-plugin-magnatune rhythmbox-plugin-zeitgeist rhythmbox-plugins rhythmbox-ubuntuone
if [ "$?" -ne 0 ]; then 
	echo "Failed on rhythmbox removal "
	exit 2
fi

# removing empathy and telepathy chat clients , and ubuntu one
sudo apt-get remove empathy empathy-common telepathy-gabble telepathy-haze telepathy-idle telepathy-indicator telepathy-logger telepathy-mission-control-5 telepathy-salut ubuntuone-client ubuntuone-client-gnome ubuntuone-control-panel ubuntuone-couch ubuntuone-installer
if [ "$?" -ne 0 ]; then 
	echo "Failed on telepathy and empathy removal "
	exit 2
fi

# removing the dvd burning software 
sudo apt-get remove brasero brasero-cdrkit brasero-common brltty dvd+rw-tools
if [ "$?" -ne 0 ]; then 
	echo "Failed on brasero removal "
	exit 2
fi

# removing evolution
sudo apt-get remove evolution-data-server evolution-data-server-common
if [ "$?" -ne 0 ]; then 
	echo "Failed on evolution removal "
	exit 2
fi

# remove the overlay scrollbar 
sudo apt-get autoremove --purge 'liboverlay-scrollbar-*'
if [ "$?" -ne 0 ]; then 
	echo "Failed on overlay scrollbar removal "
	exit 2
fi

# Now clean up the packages that are no longer needed
echo "Running AutoRemove"
sudo apt-get autoremove --purge

# now clean up the apt archives 
sudo rm /var/cache/apt/archives/*

echo "Updating Ubuntu"
sudo apt-get update

echo "apt-get webkit, numpy, gstreamster, etc"
sudo apt-get install nautilus-open-terminal htop python-webkit python-numpy gtk2-engines-pixbuf python-poppler apache2 libapache2-mod-php5 python-xlib gstreamer0.10-ffmpeg gstreamer0.10-fluendo-mp3
if [ "$?" -ne 0 ]; then 
	echo "Failed to install webkit numpy gstreamer etc"
	exit 2
fi

if [ $PLATFORM = 'armv7l' ]; then 
#echo "SUBSYSTEM==\"tty\", ATTRS{manufacturer}==\"Prolific Technology Inc.\", SYMLINK+=\"USBSerial\", MODE=0660" | sudo tee /etc/udev/rules.d/45.-my-devices.rules
	sudo cp 45.-my-devices.rules /etc/udev/rules.d/
fi 

#echo "export LIBOVERLAY_SCROLLBAR=0" | sudo tee /etc/X11/Xsession.d/80overlayscrollbars

echo "style \"scroll\"
{
    GtkScrollbar::slider-width = 30
}

class \"*\" style \"scroll\"" | sudo tee /.gtkrc-2.0

# Install Back_End first
if [ -d ~/Documents/Back_End ]; then 
	echo "Removing previous install of Back_End"
	sudo rm ~/Documents/Back_End -R
fi 

echo "Copy Back_End"
sudo cp Back_End ~/Documents -R
sudo chmod 777 ~/Documents/Back_End -R

# Install Front_End
if [ -d /var/www/Front_End ]; then
	echo "Removing previous install of Front_End"
	sudo rm /var/www/Front_End -R
fi

echo "Copy Front_End"
sudo cp Front_End /var/www -R
sudo chmod 777 /var/www/Front_End -R

echo"Copy Version"
if [ -f ~/Desktop/LOOMA_VERSION ]; then 
	echo "Removing previous version files"
	sudo rm ~/Desktop/LOOMA_VERSION*
fi 

sudo cp VERSION ~/Desktop/LOOMA_VERSION

if [ -f ~/Desktop/LoomaStartup.sh ]; then
	echo "Removing the previous copy of LoomaStartup.sh "
	sudo rm ~/Desktop/LoomaStartup.sh
fi 

echo "Copy startup script"
sudo cp LoomaStartup.sh ~/Desktop
sudo chmod 777 ~/Desktop/LoomaStartup.sh

if [ -f ~/Pictures/LoomaLogo.png ]; then
	echo "Removing previous copy of LoomaLogo"
	sudo rm ~/Pictures/LoomaLogo.png
fi

echo "Copy Looma logo"
sudo cp LoomaLogo.png ~/Pictures

sudo reboot
