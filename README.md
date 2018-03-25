# php-proxy-app
Web Proxy Application built on [**php-proxy library**](https://github.com/Athlon1600/php-proxy) ready to be installed on your server

![alt text](http://i.imgur.com/KrtU5KE.png?1 "This is how PHP-Proxy looks when installed")

## To Do List

As of **March 25**, 2018:

* Plugin for facebook.com  
* Plugin for dailymotion.com
* Better support/documentation for Plugin Development
* Better Javascript support

## Web-Proxy vs Proxy Server

Keep in mind that sites/pages that are too script-heavy or with too many "dynamic parts", may not work with this proxy script.
That is a known limitation of web proxies. For such sites, you should use an actual proxy server to route your browser's HTTP requests through:  

https://www.proxynova.com/proxy-software/


## Installation

Keep in mind that this is a **project** and not a library. Installing this via *require* would do you not good.
A project such as this, should be installed straight into the public directory of your web server.

```bash
composer create-project athlon1600/php-proxy-app:dev-master /var/www/
```

If you do not have composer or trying to host this application on a **shared hosting**, then download a pre-installed version of this app as a ZIP archive from [**www.php-proxy.com**](https://www.php-proxy.com/).

**Direct Link:**  
https://www.php-proxy.com/download/php-proxy.zip

## Keep it up-to-date

Application itself rarely will change, vast majority of changes will be done to its requirement packages like php-proxy. Simply call this command once in a while to make sure your proxy is always using the latest versions.

```
composer update
```

#### config.php

This file will be loaded into the global Config class.

#### /templates/

This should have been named "views", but for historic purposes we keep it named as templates for now.

#### /plugins/

PHP-Proxy provides many of its own native plugins, but users are free to write their own custom plugins, which could then be automatically loaded from this very folder. See /plugins/TestPlugin.php for an example.
