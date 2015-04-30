AlphaParatransit V2
================

Alpha Paratransit V2

#Deploy of project to localhost:

1. copy project to your server folder
2. when setting hosts, main folder is /frontend/www/
3. create new database, import to this database file (/common/data/structure.sql);
4. edit common/config/database.php to your mysql configuration;
5. run composer to install all dependencies;
6. open command line(console) change dir to root folder of project;
7. in command line use "sudo php console/yiic migrate" then allow migrate;
8. now you are ready to use application;

logins: admin, dispatcher, admin_reader, accountant;
password: 123456;

to add driver register him on site, confirm link in email and activate him from administrator dashboard;
