--To inject the database to mysql shell, you need to specify full path to this directory
--for ex. /full/path/example/sql mysql -u <user> -p < db_setup.sql

SET NAMES 'utf8mb4';

CREATE DATABASE IF NOT EXISTS shelter
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE shelter;

SOURCE adoptions.sql;
SOURCE animals.sql;
SOURCE schedule.sql;
SOURCE warehouse.sql;