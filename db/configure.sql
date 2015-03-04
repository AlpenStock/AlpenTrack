/*questo script deve essere eseguito dall'utente root*/

CREATE USER 'alpenstock'@'localhost' IDENTIFIED BY 'alpenstock';

GRANT ALL PRIVILEGES ON * . * TO 'alpenstock'@'localhost';

CREATE DATABASE alpentrack;