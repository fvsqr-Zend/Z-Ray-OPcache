Z-Ray-OPcache
=============

This is an extension to add functionality to the Zend Server Z-Ray. It will result 
in two additional tab(s) to be presented in the browser.
### Status
In the status tab one gets useful information about the OPcache memory usage as well as some general statistics and settings.
### Scripts
The Scripts tab will display all cached scripts plus creation and last used time information.



Setup
-----
As a Z-Ray extension is enabled after a specified function is called, one has to modify the zray.php so that it fits to the appropriate application. By default the OPcache extension is enabled after calling session_start() function. If the application doesn't call this function please change zray.php in line 12 accordingly with a a function name which is ideally called on every request.

Restrictions
----
Currently the MariaDB extension only supports PDO usage.

More Info
------------

Want to add your own Z-Ray extension? Looking for more information on Z-Ray? Try these links:

- [Z-Ray Documentation](https://github.com/zend-server-extensions/Z-Ray-Documentation)
- [Zend.com](http://www.zend.com/en/products/server/z-ray)
- [Zend Server Online Help](http://files.zend.com/help/Zend-Server/zend-server.htm#z-ray_concept.htm)
