# Python script to power on computers using GPIO pins.
# Script called by /var/www/power.php
# computer name passed as argument
import sys
from time import sleep
import RPi.GPIO as GPIO

pin=str(sys.argv[1])

print pin
GPIO.setmode(GPIO.BOARD)
GPIO.setup(pin, GPIO.OUT)
GPIO.output(pin, True)
sleep(2)
GPIO.output(pin, False)
GPIO.cleanup()
