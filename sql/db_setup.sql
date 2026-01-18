--To inject the database to mysql shell, you need to specify full path to this directory
--for ex. /full/path/example/sql mysql -u <user> -p < db_setup.sql

SET NAMES 'utf8mb4';

CREATE DATABASE IF NOT EXISTS shelter
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

CREATE USER 'admin'@'%' IDENTIFIED BY PASSWORD 'zaq1@WSX';
GRANT ALL PRIVILEGES ON mydb.* TO 'admin'@'zaq1@WSX';
WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE shelter;

SOURCE adoptions.sql;
SOURCE animals.sql;
SOURCE schedule.sql;
SOURCE warehouse.sql;
SOURCE insert_data.sql;