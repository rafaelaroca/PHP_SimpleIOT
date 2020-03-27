# PHP_SimpleIOT
Simple PHP IOT Web Application to send data, and view received data in real time or data history

This is a simple tool to send data from any device to a server with PHP and MySQL. All data is stored and can be views on a table or graphs.

# Installation
To install, simply copy all the files to a webserver with PHP 7 or later and MySQL or MariaDB support enabled.
After copying the files, create the MySQL database iot and the database user iot. Then import the table from the file database.sql. It has only one table: sensors, which stores all the received values. After creating the iot user on the database, remember to set the password on database.php

# How to use
Simply access send.php with the data you want to send, and the sensor id. For example:

http://SERVER_ADDRESS/APP_PATH/send.php?id=1&s1=23
  
http://SERVER_ADDRESS/APP_PATH/send.php?id=1&s1=1
  
http://SERVER_ADDRESS/APP_PATH/send.php?id=2&s1=12

These URLs and variants can be configured on IOT devices or other embedded systems to send data 
to server using this address.

Then access:

http://ERVER_ADDRESS/APP_PATH/index.php?id=1

index.php: allows all the data to be viewed on a graph, with adjustable label name and datetime range

rt.php: table for real time visualization of data arriving

csv.php: export all data from a given sensor to CSV to be used on Excel or LibreOffice

rtg.php: real time graph, with live update from data arriving from sensors




# Security Alert
This is a simple / educational tool, without any kind of authentication to send data to the server. Anyone with the link / URL will  able to send data to the system, so be aware of the risks!
