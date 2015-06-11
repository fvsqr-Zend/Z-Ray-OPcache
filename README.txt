Z-Ray-OPcache
=============

This extension adds two additional Z-Ray panel(s) with the following information on OPcache status and operations:
### Status
In the status tab one gets useful information about the OPcache memory usage as well as some general statistics and settings.
### Scripts
The Scripts tab will display all cached scripts plus creation and last used time information.



Setup
-----
As a Z-Ray extension is enabled after a specified function is called, one has to modify the zray.php so that it fits to the appropriate application. By default the OPcache extension is enabled after calling session_start() function. If the application doesn't call this function please change zray.php in line 12 accordingly with a a function name which is ideally called on every request.