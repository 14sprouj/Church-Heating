[![codebeat badge](https://codebeat.co/badges/1c9a09e7-bca7-4938-90bf-847f62bfeb84)](https://codebeat.co/projects/github-com-14sprouj-church-heating-master)
# Church-Heating

This project will allow heating to be set for 7 rooms remotely using a raspberry pi.

The spec is as follows:

* A calendar on a website where events can be added, edited and removed
* The calendar is password protected to stop unwanted people from changing the heating.
* The pi is hardwired to the router (as the building is too big for wifi)
* The pi is hardwired to the boilers via relay switching (probably the easiest part)
* The pi can be remotely accessed (via TeamViewer or something similar)
* The calendar needs to be able to differentiate between the seven rooms
* If the clock time is the same as the time of an event for one of the rooms it will turn on the heating for the appropriate room, which is theoretically possible as seen on this video. https://www.youtube.com/watch?v=oaf_zQcrg7g (links to scripts and products used in the video description)

There are three key parts of this project: the website that is the user interface (PHP); the database (either MySQL or SQLite) which stores the times the boilers turn on and off; the Python script which checks the database to see when boilers should turn on and off. The script ultimately has control over the boilers as the raspberry pi is plugged into them. 

The index.php file is the homepage of the website. This page will allow the end user to be able to glance at the status of all the boilers (ON, OFF or STATUS UNKNOWN). If they is a fault in the system, the pi can tell which boiler is down and will be able to tell the user how to troubleshoot the issue.
