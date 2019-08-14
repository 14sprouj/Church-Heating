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

The index.html file is the homepage of the website.
