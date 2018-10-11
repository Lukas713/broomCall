drop database IF EXISTS 1broomcall;

create database 1broomCall default character set utf8;

/* c:\xampp\mysql\bin\mysql.exe -ulukas -p123456789 --default_character_set=utf8 < C:\xampp\htdocs\bootstrapBroomCall\script.sql*/

USE 1broomCall ;

CREATE TABLE squad 
(
    id INT NOT NULL primary key AUTO_INCREMENT,
    squadNumber INT,
    squadColor VARCHAR(15)
);

create table person
  (
    id int primary key not null auto_increment,
    firstName varchar(50) not null,
    lastName varchar(50) not null,
    email varchar(50) not null,
    passwrd varchar(255) not null,
    roles int not null
  );

create table roles
  (
    id int primary key not null auto_increment,
    roleName varchar(10)
  );


CREATE TABLE  users 
(
  id INT NOT NULL primary key AUTO_INCREMENT,
  phoneNumber varchar(20),
  person int
);

CREATE TABLE services 
(
    id INT NOT NULL primary key AUTO_INCREMENT,
    serviceName VARCHAR(50) not NULL ,
    price DECIMAL(10,0) not NULL
);


CREATE TABLE cleanlevel 
(
    id INT primary key AUTO_INCREMENT,
    levelName VARCHAR(20),
    priceCoeficient decimal(10,2)
);

CREATE TABLE agreement (
  id INT NOT NULL primary key AUTO_INCREMENT,
  orderDate DATETIME,
  approveDate DATETIME,
  serviceDate DATETIME,
  city VARCHAR(20),
  adress VARCHAR(50),
  squad INT,
  users INT,
  cleanLevel INT,
  services int,
  approved boolean DEFAULT false,
  checked boolean DEFAULT false
);

CREATE TABLE department 
(
  id INT NOT NULL primary key AUTO_INCREMENT,
  depName VARCHAR(20)
);

CREATE TABLE employees
 (
  id INT NOT NULL primary key AUTO_INCREMENT,
  phoneNumber VARCHAR(20) NOT NULL,
  city VARCHAR(50) ,
  zipCode VARCHAR(50),
  adress VARCHAR(50),
  oib VARCHAR(15),
  IBAN VARCHAR(50),
  person int,
  squad INT,
  department INT
  );

  alter table person add foreign key(roles) references roles(id); 

  alter table users add foreign key(person) references person(id); 

  alter table employees add foreign key(squad) references squad(id);
  alter table employees add foreign key(department) references department(id);
  alter table employees add foreign key(person) references person(id); 

  alter table agreement add foreign key(squad) references squad(id);
  alter table agreement add foreign key(services) references services(id);
  alter table agreement add foreign key(cleanLevel) references cleanLevel(id);
  alter table agreement add foreign key(users) references users(id);

insert into squad(id, squadNumber, squadColor) values 
(null, 1, "#256645"),
(null, 2, "#AA0000"),
(null, 3, "#0000FF"),
(null, 4, "-");

insert into roles(roleName) VALUES
("admin"),
("operater"),
("user");

insert into department(id, depName) values 
(null, "Cleaners"),
(null, "Logistics"),
(null, "Administration"),
(null, "Technics"),
(null, "No department");

insert into services(id, serviceName, price) values 
(null, "1 bedroom", 100),
(null, "2 bedroom", 200),
(null, "3 bedroom", 300);

insert into cleanlevel(id, levelName, priceCoeficient) values 
(null, "Regular", 1.00),
(null, "Deep cleaning", 1.45),
(null, "Move in/out", 1.75);

insert into person (firstName, lastName, email, passwrd, roles) values ('Fredia', 'McGeever', 'fmcgeever0@issuu.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 2);
insert into person (firstName, lastName, email, passwrd, roles) values ('Marsiella', 'Yarnold', 'myarnold1@dropbox.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 2);
insert into person (firstName, lastName, email, passwrd, roles) values ('Penny', 'Bilson', 'pbilson2@chronoengine.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 2);
insert into person (firstName, lastName, email, passwrd, roles) values ('Kevina', 'Balmadier', 'kbalmadier3@weebly.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 2);
insert into person (firstName, lastName, email, passwrd, roles) values ('Christen', 'Mills', 'cmills4@bloglines.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 2);
insert into person (firstName, lastName, email, passwrd,  roles) values ('Ronnica', 'Martill', 'rmartill0@oakley.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 3);
insert into person (firstName, lastName, email, passwrd,  roles) values ('Maxie', 'Sauven', 'msauven1@bing.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 3);
insert into person (firstName, lastName, email, passwrd,  roles) values ('Bridie', 'Krolman', 'bkrolman2@tinyurl.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 3);
insert into person (firstName, lastName, email, passwrd,  roles) values ('Gib', 'McCarver', 'gmccarver3@etsy.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 3);
insert into person (firstName, lastName, email, passwrd,  roles) values ('Tomi', 'Carrabot', 'tcarrabot4@prnewswire.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 3);
insert into person (firstName, lastName, email, passwrd,  roles) values ('admin', 'admin', 'admin@admin.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 1);
insert into person (firstName, lastName, email, passwrd,  roles) values ('user', 'user', 'user@user.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 3);
insert into person (firstName, lastName, email, passwrd,  roles) values ('operater', 'operater', 'operater@operater.com', '$2y$12$dIcWikfkOhvPCOujwNfuDuY1OezqCuU8kbezd8kKqRT.rnQnvMBjK', 2);

insert into employees (phoneNumber, person, squad, department) values ('533-896-0630', 1, 2, 4);
insert into employees (phoneNumber, person, squad, department) values ('871-361-2383', 2, 2, 3);
insert into employees (phoneNumber, person, squad, department) values ('490-273-0700', 3, 1, 1);
insert into employees (phoneNumber, person, squad, department) values ('469-888-7269', 4, 2, 5);
insert into employees (phoneNumber, person, squad, department) values ('721-598-6218', 5, 1, 4);

insert into users (phoneNumber, person) values ('716-347-0997', 6);
insert into users (phoneNumber, person) values ('351-678-7276', 8);
insert into users (phoneNumber, person) values ('740-298-5119', 9);
insert into users (phoneNumber, person) values ('806-271-3412', 7);
insert into users (phoneNumber, person) values ('806-271-3412', 10);
insert into users (person) values (11);
insert into users (person) values (12);
insert into users (person) values (13);

insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-01 09:50:58', '2018-04-29 21:35:24', '2018-05-29 22:36:57', 'Kadugede', '7 Marcy Plaza', 1, 4, 2, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-12-07 11:42:11', '2018-06-17 07:45:32', '2018-02-22 19:22:50', 'Badian', '9 Melody Court', 2, 6, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-27 21:34:54', '2018-02-21 17:49:58', '2018-02-19 09:11:16', 'Nyrob', '2 Hoffman Way', 2, 1, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-21 15:00:50', '2018-07-16 20:31:19', '2018-02-01 09:25:27', 'Nanhe', '0478 Artisan Court', 1, 3, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-08-23 02:47:11', '2018-04-09 23:18:46', '2018-05-19 06:41:34', 'Zaleszany', '676 Kipling Lane', 1, 1, 2, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-10 15:02:40', '2018-06-06 09:00:39', '2018-05-08 13:14:13', 'Puyuan', '444 East Lane', 2, 5, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-08-04 08:55:00', '2018-04-05 13:46:17', '2018-04-10 18:14:09', 'Al Jamālīyah', '25628 Summer Ridge Circle', 2, 1, 3, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-12-23 13:07:15', '2018-06-21 23:11:12', '2018-06-26 06:43:20', 'Baiba', '6 7th Center', 2, 2, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-18 17:04:49', '2018-08-11 11:57:29', '2018-11-10 19:23:40', 'Dingle', '4472 School Drive', 1, 2, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-24 04:31:02', '2018-07-03 13:29:26', '2018-05-31 15:18:08', 'Aimin', '0653 Ruskin Hill', 2, 5, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-11-02 19:47:35', '2018-11-10 20:18:52', '2018-10-10 07:41:50', 'Casal das Figueiras', '3 John Wall Center', 2, 2, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-30 00:33:18', '2018-02-18 03:02:18', '2018-10-10 00:24:24', 'Mirošov', '3482 Ryan Park', 2, 1, 3, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-13 15:41:30', '2018-02-17 17:15:23', '2018-06-02 04:20:16', 'Grenoble', '457 Graedel Place', 1, 4, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-11-30 01:31:57', '2018-01-04 23:39:17', '2018-05-15 13:53:33', 'Nong Ki', '91 Waubesa Point', 2, 3, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-23 08:14:16', '2018-08-13 06:17:05', '2018-03-22 22:21:17', 'Kozhva', '11285 Darwin Court', 2, 5, 3, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-21 18:04:53', '2018-10-19 03:25:46', '2018-04-14 02:46:15', 'Nunchía', '628 Hermina Trail', 2, 1, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-06 18:03:31', '2018-05-25 20:24:30', '2018-06-24 05:51:28', 'Agbannawag', '32 Johnson Road', 2, 6, 2, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-11 13:35:56', '2018-08-02 11:46:59', '2018-07-08 16:36:29', 'Novotroitsk', '0035 Sachtjen Circle', 1, 1, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-29 08:59:53', '2018-07-24 22:17:08', '2018-02-20 22:26:03', 'Balete', '881 Wayridge Trail', 1, 1, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-23 21:16:05', '2018-08-07 15:24:40', '2018-10-16 22:59:03', 'Changqiao', '93464 Warrior Court', 2, 6, 1, 2, true, true);


