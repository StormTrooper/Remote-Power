These scripts all you to remotely power on and off as well as reset computers using a web interface on the Raspberry Pi.

The R-Pi interfaces with the computers using its GPIO pins and a optocoupler. One connected to the reset switch, and the other to the power button.

Install php and apache2 on th Pi.
http://www.raspberrypi.org/documentation/remote-access/web-server/apache.md


1) Copy \images to /var/www/images.

2) Copy power.py and reset.py to /usr/scripts and make them executable.

3) Copy computers.txt, index.php, power.php and resetconfirm.php to /var/www

computers.txt contains a list of computers and the corresponding GPIO reset/power pins
Eg. In the example computer-a - power pin is connected to GPIO7 and reset pin is connected to GPIO8.

If you get "VCHI initialization failed" for the temperature the www-data user needs to be added to the video group:

sudo usermod -G video www-data
