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


insert into person (id, firstName, lastName, email, passwrd, roles) values (1, 'Mallissa', 'Demer', 'mdemer0@nature.com', 'KQZ0sm2nGq1', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (2, 'Elenore', 'Eddowis', 'eeddowis1@acquirethisname.com', 'tIHTYcOx8', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (3, 'Alisa', 'Zebedee', 'azebedee2@wufoo.com', '1YQlu9yR7', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (4, 'Leeland', 'Reason', 'lreason3@tuttocitta.it', '31nN896', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (5, 'Jarvis', 'Bratton', 'jbratton4@hubpages.com', 'RPeFXfxpkv', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (6, 'Junia', 'Cuttelar', 'jcuttelar5@walmart.com', 'vAQVQnfMP', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (7, 'William', 'Pea', 'wpea6@privacy.gov.au', 'hE66idf', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (8, 'Braden', 'Bohling', 'bbohling7@disqus.com', 'u4mEOta', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (9, 'Amory', 'Gronous', 'agronous8@bandcamp.com', 'BevXKYZEPt', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (10, 'Ruttger', 'Coventon', 'rcoventon9@ebay.com', '80wKhkZkS', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (11, 'Gertrude', 'Reedy', 'greedya@dailymotion.com', 'DyWyVpXZxl', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (12, 'Jameson', 'Jeenes', 'jjeenesb@bloomberg.com', 'ydP9EipnS3g', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (13, 'Kenyon', 'Wibberley', 'kwibberleyc@cnn.com', '53urKg7Ez', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (14, 'Matilde', 'Glowinski', 'mglowinskid@tripadvisor.com', 'GF25G7', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (15, 'Sebastiano', 'Paolacci', 'spaolaccie@usda.gov', '2kQht59MPaUi', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (16, 'Licha', 'Brislawn', 'lbrislawnf@dailymotion.com', 'UQQW6gaK', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (17, 'Alwin', 'Trew', 'atrewg@epa.gov', 'zpRDtrq3MvM', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (18, 'Rudolph', 'Adaway', 'radawayh@wordpress.org', '9YEWxg0kk', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (19, 'Glyn', 'O''Halligan', 'gohalligani@tinyurl.com', 'qCDxD9i2t5Et', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (20, 'Nanni', 'Priddis', 'npriddisj@pinterest.com', 'LONkoZ', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (21, 'Amitie', 'Hazelby', 'ahazelbyk@sciencedaily.com', 'rks5f1ADnI', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (22, 'Helga', 'Reap', 'hreapl@wiley.com', 'vwOJ2Pp', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (23, 'Arabelle', 'McLukie', 'amclukiem@earthlink.net', '20YB6yC', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (24, 'Lennie', 'Shawdforth', 'lshawdforthn@feedburner.com', 'kRawJqg1', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (25, 'Celka', 'Matthiae', 'cmatthiaeo@boston.com', 'BYy87Umk', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (26, 'Rolf', 'Dooher', 'rdooherp@woothemes.com', 'dqb6PX03C', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (27, 'Alleen', 'Mularkey', 'amularkeyq@goo.ne.jp', 'RkDPiqs9v', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (28, 'Saw', 'Stienham', 'sstienhamr@bloomberg.com', 'XK7qbVjjgzx1', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (29, 'Andrus', 'Morales', 'amoraless@netvibes.com', 'NjCMwe', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (30, 'Washington', 'Blair', 'wblairt@bloglines.com', 'Iggw6nP', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (31, 'Dorothea', 'Dearl', 'ddearlu@nydailynews.com', 'UzqLbUWJE1Vp', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (32, 'Georgena', 'McGougan', 'gmcgouganv@nba.com', 'hWYVE6', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (33, 'Nikita', 'Brimicombe', 'nbrimicombew@webs.com', 'XRQ8xzfsTn', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (34, 'Minta', 'Dillamore', 'mdillamorex@thetimes.co.uk', 'OzBP9sY2', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (35, 'Bern', 'Mitskevich', 'bmitskevichy@nymag.com', 'D5c5LG', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (36, 'Brandy', 'Gebuhr', 'bgebuhrz@berkeley.edu', 'MpsTS2I9b', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (37, 'Beaufort', 'Maden', 'bmaden10@acquirethisname.com', 'LSB31u', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (38, 'Kellen', 'Rubartelli', 'krubartelli11@umich.edu', 'fBL3yq', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (39, 'Mareah', 'Shanklin', 'mshanklin12@tripadvisor.com', 'qgS7rdk', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (40, 'Ilsa', 'Spira', 'ispira13@amazon.co.jp', 'mLk9mgRYa', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (41, 'Bertina', 'Brolechan', 'bbrolechan14@nba.com', 'xSer1zk2f', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (42, 'Milzie', 'Dwelly', 'mdwelly15@disqus.com', 'MHTctIBbBNFW', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (43, 'Fransisco', 'Alexis', 'falexis16@tripod.com', '95T4NkNDKyE', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (44, 'Eleen', 'MacNamara', 'emacnamara17@wikimedia.org', 'nLdlRIO', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (45, 'Weider', 'Middle', 'wmiddle18@businessweek.com', 'Bxk48g', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (46, 'Priscella', 'Mohun', 'pmohun19@redcross.org', 'fbxl9mf', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (47, 'Herschel', 'Daugherty', 'hdaugherty1a@census.gov', 'ldl3zbsidDd', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (48, 'Morie', 'Jordine', 'mjordine1b@cdbaby.com', 'dFpShi', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (49, 'Benedetta', 'Trudgion', 'btrudgion1c@gravatar.com', 'aDSorlURDk4', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (50, 'Toddy', 'Hallgath', 'thallgath1d@spotify.com', 'E3G45XU', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (51, 'Zelig', 'McGenn', 'zmcgenn1e@hc360.com', 'G0fFW9IaZPI', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (52, 'Jami', 'Malinson', 'jmalinson1f@amazon.de', 'Wcx4KI91z', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (53, 'Anna-diane', 'Leggott', 'aleggott1g@nature.com', 'v4BRYlIF', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (54, 'Mala', 'Poyser', 'mpoyser1h@examiner.com', 'nWwVm4ij', 2);
insert into person (id, firstName, lastName, email, passwrd, roles) values (55, 'Christine', 'Lobley', 'clobley1i@merriam-webster.com', 'MLhZGYf3', 2);



insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('993-632-9692', 'El Colorado', '4618', '7582 Forest Dale Terrace', '2582222569', 'RS12 6173 2527 3476 8298 67', 1, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('891-920-8843', 'Kabo', null, '7 Crownhardt Circle', '0472726552', 'PS91 LSAW LEWS HTLR K0WY DWGC G6RD H', 2, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('536-361-1403', 'Dagang', null, '5 Anniversary Lane', '9511365495', 'FR25 6132 4420 886M QOUS PRAW F53', 3, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('537-575-3778', 'Askim', '436 23', '400 New Castle Court', '5464925856', 'MD33 G5FF ZYFG RB8H AM5V SFZR', 4, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('185-696-7463', 'Shuanghe', null, '790 Alpine Lane', '3122745615', 'LU11 9676 RNR9 ZQIN C4VF', 5, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('377-488-0214', 'Henghe', null, '4 Norway Maple Circle', '4797545623', 'LT40 9354 7341 4228 3637', 6, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('636-467-8890', 'New Pandanon', '8419', '4 Chinook Court', '1596394242', 'BR92 9625 2054 8587 5306 9722 576Y D', 7, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('614-659-2910', 'Krechevitsy', '346020', '085 Granby Road', '8262626044', 'DK79 8611 2399 9982 30', 8, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('253-185-5457', 'Ylöjärvi', '33480', '7 Spaight Street', '1434963365', 'VG81 HDPX 4198 6740 8881 2241', 9, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('313-576-8153', 'Verkhniy Lomov', '442130', '9651 Carberry Trail', '7128602100', 'FR92 5394 1544 61IO UHT1 WXDC G72', 10, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('880-176-1527', 'Hebian', null, '8 Summerview Point', '5456063743', 'BE68 3012 2622 2129', 11, 4, 4);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('496-294-5995', 'Igarapé', '32900-000', '65550 Eggendart Place', '5540553128', 'AE48 0592 3791 0847 1608 852', 12, 4, 4);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('839-263-4486', 'Sabang', '8702', '290 Shasta Hill', '3318311723', 'DE95 8899 3048 6916 0736 16', 13, 2, 4);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('876-667-9291', 'Le Mans', '72052 CEDEX 2', '86479 Ridgeway Court', '8050856747', 'BH49 MUKI XHAJ 5SR8 ACJC AV', 14, 4, 4);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, person, squad, department) values ('705-640-3114', 'Lokosovo', '368814', '83354 Vermont Terrace', '6145665742', 'BE33 7089 9210 6662', 15, 4, 4);


insert into users (phoneNumber, person) values ('938-790-8156', 16);
insert into users (phoneNumber, person) values ('618-895-2420', 17);
insert into users (phoneNumber, person) values ('744-833-6434', 18);
insert into users (phoneNumber, person) values ('251-348-8890', 19);
insert into users (phoneNumber, person) values ('881-885-9398', 20);
insert into users (phoneNumber, person) values ('992-288-8350', 21);
insert into users (phoneNumber, person) values ('936-741-1619', 22);
insert into users (phoneNumber, person) values ('313-281-9929', 23);
insert into users (phoneNumber, person) values ('872-272-1126', 24);
insert into users (phoneNumber, person) values ('448-948-4083', 25);
insert into users (phoneNumber, person) values ('488-319-3283', 26);
insert into users (phoneNumber, person) values ('247-790-4704', 27);
insert into users (phoneNumber, person) values ('614-864-4858', 28);
insert into users (phoneNumber, person) values ('224-583-8437', 29);
insert into users (phoneNumber, person) values ('610-378-4787', 30);
insert into users (phoneNumber, person) values ('767-423-7703', 31);
insert into users (phoneNumber, person) values ('466-914-5317', 32);
insert into users (phoneNumber, person) values ('746-679-2737', 33);
insert into users (phoneNumber, person) values ('179-297-1464', 34);
insert into users (phoneNumber, person) values ('610-171-0382', 35);
insert into users (phoneNumber, person) values ('521-426-0179', 36);
insert into users (phoneNumber, person) values ('477-825-5003', 37);
insert into users (phoneNumber, person) values ('173-304-1749', 38);
insert into users (phoneNumber, person) values ('677-200-0546', 39);
insert into users (phoneNumber, person) values ('306-874-8955', 40);
insert into users (phoneNumber, person) values ('355-491-7573', 41);
insert into users (phoneNumber, person) values ('905-798-9031', 42);
insert into users (phoneNumber, person) values ('173-723-7577', 43);
insert into users (phoneNumber, person) values ('643-701-4782', 44);
insert into users (phoneNumber, person) values ('839-734-6033', 45);
insert into users (phoneNumber, person) values ('438-343-9598', 46);
insert into users (phoneNumber, person) values ('967-455-1589', 47);
insert into users (phoneNumber, person) values ('984-183-6923', 48);
insert into users (phoneNumber, person) values ('966-827-5147', 49);
insert into users (phoneNumber, person) values ('949-180-6204', 50);
insert into users (phoneNumber, person) values ('171-724-9542', 51);
insert into users (phoneNumber, person) values ('224-179-1954', 52);
insert into users (phoneNumber, person) values ('314-747-2510', 53);
insert into users (phoneNumber, person) values ('153-991-6429', 54);
insert into users (phoneNumber, person) values ('091-551-7903', 55);



insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-15 04:00:45', '2018-01-26 07:14:44', '2018-10-04 19:14:37', 'Elato', '345 South Circle', 1, 38, 1, 2, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-03 02:33:56', '2018-06-04 03:55:21', '2017-11-15 17:47:43', 'Puerto López', '57902 Russell Avenue', 1, 8, 1, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-11 16:04:41', '2018-05-10 07:12:48', '2018-06-08 13:36:30', 'Waajid', '12258 Dapin Plaza', 1, 5, 2, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-11 01:15:08', '2018-04-25 22:18:49', '2017-12-31 16:12:39', 'Longhuashan', '38 Loftsgordon Avenue', 2, 34, 3, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-15 14:21:57', '2018-07-27 22:14:49', '2018-07-19 05:41:30', 'Zephyrhills', '9 Dryden Lane', 1, 38, 2, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-08-20 07:01:11', '2017-10-24 04:00:52', '2018-08-16 01:47:55', 'Bŭka', '44538 Mcguire Terrace', 1, 28, 1, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-05 11:18:44', '2018-06-12 02:11:23', '2017-11-27 01:39:54', 'Angren', '14 Dovetail Trail', 1, 33, 3, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-04 04:32:09', '2017-10-28 07:11:31', '2018-09-09 01:49:09', 'Guaíra', '493 Maryland Circle', 2, 3, 1, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-14 07:50:20', '2017-12-25 03:51:57', '2017-11-18 18:23:41', 'Nueva Loja', '728 Stone Corner Circle', 1, 10, 1, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-08-10 19:30:26', '2017-12-20 17:35:46', '2018-02-15 01:21:28', 'Saint-Claude', '755 Pleasure Plaza', 1, 28, 3, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-24 06:26:47', '2018-02-09 01:41:59', '2018-09-17 06:00:54', 'Sihe', '7084 Sherman Terrace', 1, 8, 2, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-22 20:20:10', '2018-06-05 14:58:33', '2018-09-17 12:51:41', 'Seymchan', '112 Roxbury Drive', 1, 29, 2, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-07 04:48:48', '2017-12-22 08:13:40', '2017-12-01 13:57:43', 'Udon Thani', '4 Fairfield Plaza', 1, 35, 1, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-31 14:31:34', '2018-03-01 23:01:37', '2018-02-08 02:51:03', 'Novoishimskiy', '07502 Utah Terrace', 2, 32, 2, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-18 18:23:11', '2018-02-09 22:12:01', '2018-01-25 11:19:48', 'Lubowidz', '543 Rieder Trail', 1, 17, 2, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-04 07:31:08', '2018-07-27 03:45:14', '2018-02-23 19:55:17', 'Calaoagan', '1 Sloan Park', 1, 31, 1, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-02 16:39:12', '2018-07-09 02:33:40', '2017-12-19 05:25:09', 'Nansha', '8 Dottie Lane', 2, 35, 2, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-03 13:49:35', '2018-08-17 10:38:16', '2018-01-25 04:15:55', 'Koroyo', '80940 Sutteridge Alley', 2, 6, 3, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-14 21:47:30', '2018-06-19 15:41:35', '2018-08-22 07:08:26', 'Waipawa', '68899 Jenna Court', 2, 37, 3, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-13 13:15:43', '2018-06-24 09:07:16', '2018-06-04 16:30:15', 'Aubenas', '80926 Lunder Alley', 2, 29, 2, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-10-27 13:53:27', '2018-07-18 09:08:15', '2018-06-29 09:01:42', 'Xialaba', '39 Sugar Plaza', 1, 12, 2, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-22 22:43:52', '2018-07-28 16:25:54', '2018-06-10 20:05:23', 'Promyshlennovskiy', '90408 Bluestem Alley', 2, 7, 2, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-10-24 22:32:05', '2018-03-24 23:15:37', '2018-10-10 00:01:16', 'Gongji', '775 Colorado Circle', 2, 16, 1, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-15 11:41:36', '2018-08-16 22:41:06', '2018-07-19 15:12:26', 'Batiano', '502 Almo Center', 2, 4, 2, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-08 12:51:53', '2018-05-05 10:30:51', '2018-06-29 07:50:39', 'Xiaxihao', '7573 Talmadge Way', 1, 25, 3, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-11 17:45:25', '2018-04-27 23:08:22', '2018-07-05 12:19:51', 'Oxford', '83 Gulseth Center', 1, 30, 1, 3, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-31 01:55:45', '2017-12-17 21:18:56', '2018-09-19 14:31:24', 'Smyga', '4935 Clemons Terrace', 2, 15, 2, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-08 18:02:06', '2018-09-04 11:55:40', '2017-11-24 18:16:50', 'Calape', '2229 Fallview Court', 1, 26, 2, 2, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-21 21:18:00', '2018-05-21 13:44:24', '2018-08-16 20:03:26', 'Turka', '2 Sutherland Center', 1, 12, 2, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-08 14:27:13', '2018-06-30 10:30:44', '2018-02-25 09:33:47', 'Verkhniy Avzyan', '780 Fremont Pass', 2, 38, 1, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-02 19:05:48', '2018-06-22 17:34:41', '2018-04-06 03:06:39', 'Hradec Králové', '13 Meadow Vale Parkway', 1, 34, 1, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-02 01:20:51', '2017-11-25 00:44:37', '2018-04-20 16:38:19', 'Angra dos Reis', '64 Veith Place', 1, 38, 1, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-20 19:42:38', '2018-08-24 10:51:48', '2018-04-10 01:44:47', 'Blawi', '150 1st Park', 2, 22, 1, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-12-04 20:37:22', '2018-02-01 03:29:28', '2017-12-01 09:30:36', 'Chendian', '3 Armistice Plaza', 2, 23, 3, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-03 22:49:25', '2017-11-25 02:43:34', '2018-07-27 03:53:43', 'Mineiros', '32449 Dorton Circle', 2, 17, 3, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-06 19:04:23', '2018-03-10 13:17:14', '2017-10-27 12:52:04', 'Herrán', '0600 Beilfuss Pass', 2, 4, 2, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-14 00:50:52', '2018-07-24 18:53:20', '2018-01-05 18:29:52', 'Iraquara', '7429 Haas Junction', 1, 14, 1, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-28 22:44:22', '2018-06-10 14:21:10', '2018-07-31 14:25:28', 'Bistrinci', '36606 Sullivan Way', 2, 26, 2, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-09 06:34:38', '2017-10-29 21:51:48', '2018-09-28 05:43:58', 'Wattala', '6 Bonner Pass', 1, 33, 2, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-28 17:09:04', '2018-02-15 14:06:21', '2018-03-30 06:01:04', 'Güines', '4781 Memorial Hill', 2, 31, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-16 18:29:57', '2017-11-28 17:05:59', '2018-05-13 02:59:05', 'Fradelos', '971 Scofield Avenue', 1, 1, 2, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-21 02:05:07', '2018-09-14 22:29:27', '2018-05-03 09:25:49', 'Kiten', '6 Hintze Road', 2, 37, 2, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-22 20:17:44', '2018-08-17 21:40:34', '2018-01-30 09:05:19', 'Puerto Parra', '563 Westend Pass', 2, 40, 1, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-11 17:55:05', '2018-06-13 00:51:00', '2018-02-25 10:16:15', 'Khuma', '820 American Ash Terrace', 1, 7, 1, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-18 07:02:22', '2017-12-31 00:42:06', '2018-09-28 11:48:58', 'Dabao’anzhen', '01632 Bashford Place', 1, 35, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-01 00:20:51', '2017-10-27 15:57:32', '2018-03-02 02:03:03', 'Marietta', '573 Brown Road', 2, 24, 1, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-09 10:30:53', '2017-11-26 07:43:56', '2018-05-03 14:43:36', 'Keratéa', '61107 Melby Drive', 1, 23, 3, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-18 07:52:24', '2017-11-08 13:56:22', '2018-02-08 16:32:49', 'Namyang-dong', '69794 Northland Street', 2, 15, 2, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-27 11:40:06', '2018-10-23 16:47:44', '2017-12-22 01:01:49', 'Jiucheng', '31 Sloan Court', 2, 35, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-15 03:54:04', '2018-07-24 23:30:06', '2018-07-24 14:32:24', 'Lianghekou', '7588 Crescent Oaks Plaza', 1, 9, 2, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-19 08:43:36', '2017-11-20 06:05:31', '2018-09-11 05:18:39', 'Casal', '38 Mesta Road', 1, 6, 3, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-11 04:43:10', '2017-11-06 02:57:57', '2018-04-22 12:07:33', 'Mabu', '5457 Acker Junction', 2, 1, 2, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-12-14 12:42:10', '2018-10-03 04:05:24', '2018-04-09 08:23:05', 'Karangparwa', '77770 Valley Edge Avenue', 1, 26, 1, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-07 12:30:40', '2018-04-26 09:12:42', '2018-05-28 17:00:56', 'Ciepielów', '252 Hansons Plaza', 2, 39, 1, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-02 13:31:15', '2018-09-10 20:20:27', '2018-10-02 03:43:45', 'Anávra', '4 Logan Lane', 1, 9, 3, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-08-07 03:27:51', '2018-04-24 10:30:34', '2018-02-08 15:56:53', 'Houzhai', '974 Hanover Circle', 1, 36, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-21 07:42:14', '2018-07-15 16:42:32', '2018-08-25 14:37:33', 'Carrasqueira', '67 Heath Center', 2, 25, 3, 3, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-08-06 19:02:38', '2018-06-24 03:06:01', '2017-12-12 03:45:19', 'Chagou', '480 Rockefeller Junction', 1, 9, 3, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-21 14:37:59', '2018-02-24 03:44:52', '2018-09-22 01:09:37', 'Yukhnov', '59 Clyde Gallagher Way', 1, 5, 2, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-07 05:39:32', '2018-09-05 16:36:41', '2018-07-17 14:33:40', 'Zásmuky', '13035 Butternut Park', 2, 37, 3, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-10 00:30:08', '2018-07-11 10:50:22', '2018-05-10 09:24:40', 'Baru', '7 Scofield Center', 1, 23, 1, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-10 13:24:48', '2018-10-16 06:34:07', '2018-08-08 18:18:56', 'Xiaochuan', '55502 Haas Crossing', 1, 28, 1, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-07 11:00:20', '2018-06-15 04:24:50', '2018-05-24 15:14:29', 'Xai-Xai', '895 Garrison Hill', 1, 30, 2, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-08 00:51:32', '2018-02-22 12:28:01', '2017-12-28 15:22:14', 'Pindushi', '941 Jenifer Place', 1, 14, 2, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-12 16:25:52', '2017-10-24 21:40:39', '2018-01-06 16:12:04', 'Ust’-Kut', '5 Anniversary Circle', 2, 1, 1, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-12-07 23:05:40', '2018-02-01 03:18:29', '2018-01-03 09:15:38', 'Bagakay', '8 Fair Oaks Parkway', 2, 31, 1, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-04 13:33:13', '2018-07-02 14:35:05', '2018-07-16 15:16:27', 'Kadubadak', '5 Schurz Junction', 2, 12, 1, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-03 23:36:27', '2017-11-30 18:20:34', '2017-12-30 06:18:33', 'Davydovo', '179 Dakota Pass', 2, 33, 1, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-20 11:26:06', '2018-02-16 20:11:50', '2018-06-21 05:52:05', 'Yam', '6611 Haas Hill', 2, 4, 2, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-12-26 15:37:28', '2017-12-08 03:27:20', '2017-10-31 12:33:29', 'Vsetín', '9846 Spenser Circle', 2, 7, 2, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-14 02:06:56', '2018-06-07 15:35:53', '2018-03-10 17:21:44', 'Setonokalong', '71990 Badeau Parkway', 1, 34, 1, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-10-14 11:10:30', '2018-09-28 19:19:26', '2018-05-14 21:46:37', 'Guanfang', '95 Farragut Place', 1, 32, 1, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-11 10:23:07', '2018-10-10 01:56:51', '2017-12-09 22:45:11', 'Palikir - National Government Center', '7 Hoepker Way', 2, 39, 3, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-12-03 22:15:25', '2018-08-24 07:52:22', '2018-09-18 20:07:21', '‘Awartā', '5 Banding Court', 1, 27, 1, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-16 15:29:51', '2018-01-29 19:05:02', '2018-03-18 22:28:50', 'Soavinandriana', '71 Dryden Lane', 1, 31, 1, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-20 08:50:08', '2017-11-10 06:01:57', '2018-03-20 20:58:14', 'Fatikchari', '005 Marquette Center', 2, 27, 3, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-13 12:59:19', '2018-01-25 05:18:24', '2017-11-13 10:16:07', 'Bagratashen', '72 Hagan Terrace', 2, 34, 3, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-16 14:49:12', '2018-03-07 11:33:16', '2018-01-25 03:42:19', 'Danxia', '61982 Bobwhite Hill', 1, 8, 3, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-16 14:48:33', '2017-10-29 09:27:14', '2017-10-31 03:18:14', 'Bęczarka', '33 Pennsylvania Parkway', 2, 24, 2, 3, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-27 20:46:27', '2018-02-03 01:26:25', '2018-10-18 02:00:54', 'Yanweigang', '750 Shoshone Road', 1, 38, 1, 3, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-30 22:39:03', '2018-08-23 13:09:59', '2018-07-04 15:51:40', 'Sena', '55320 Hermina Avenue', 2, 22, 2, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-08 02:11:19', '2018-01-15 11:39:05', '2017-10-27 03:34:50', 'Motygino', '17 Hauk Junction', 1, 8, 3, 3, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-19 04:49:44', '2017-10-29 00:42:33', '2018-03-07 03:08:45', 'Vermil', '897 Sommers Point', 1, 4, 2, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-06 00:33:40', '2018-10-11 21:46:24', '2018-05-04 06:14:58', 'Wuyang', '5 Corscot Drive', 1, 3, 2, 1, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-04 17:44:14', '2018-05-15 13:11:57', '2018-01-31 13:34:20', 'Guarabira', '4 Springs Trail', 2, 29, 3, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-11-01 16:23:44', '2017-12-22 18:26:29', '2017-12-09 11:47:55', 'Terre Haute', '77949 Cascade Alley', 1, 31, 2, 2, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-10-28 05:14:08', '2018-02-14 19:02:07', '2018-03-16 20:31:54', 'Ratoath', '0 Sachs Trail', 2, 17, 3, 1, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-08 02:20:53', '2018-05-06 20:19:10', '2018-07-31 13:19:57', 'Oji River', '792 Heffernan Alley', 2, 11, 3, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-18 02:31:11', '2018-10-02 23:46:20', '2018-05-03 01:48:47', 'Krajan Sidodadi', '7761 Heath Junction', 2, 10, 3, 3, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2017-10-24 16:54:27', '2018-04-14 05:59:50', '2018-06-21 20:57:46', 'Fenyan', '5 Little Fleur Junction', 2, 38, 2, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-04-17 03:51:42', '2018-03-19 04:36:02', '2018-03-14 15:36:06', 'Saint-Ouen', '4 Sunbrook Alley', 2, 19, 2, 3, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-22 01:46:12', '2018-01-09 21:55:13', '2018-06-03 19:27:01', 'Yangjiapo', '7 Delaware Terrace', 2, 2, 2, 3, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-07-03 18:06:21', '2018-05-07 08:05:40', '2017-11-17 18:22:23', 'Teslić', '20896 Darwin Park', 1, 34, 1, 2, false, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-03-25 17:43:59', '2017-11-25 17:26:06', '2018-02-08 15:35:56', 'Zhaixi', '996 Hallows Crossing', 1, 38, 1, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-05-16 23:29:55', '2018-04-13 18:45:51', '2018-07-06 00:33:39', 'Meaux', '1 Mesta Crossing', 2, 28, 2, 2, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-02-01 00:42:56', '2018-02-28 00:11:21', '2018-06-01 09:21:36', 'Starcevica', '14157 Elka Court', 2, 36, 2, 1, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-06-11 03:43:20', '2017-11-05 06:40:47', '2017-12-08 04:30:55', 'Tanjung Pandan', '33609 High Crossing Junction', 2, 27, 2, 1, true, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-01-24 00:33:18', '2018-07-24 22:26:17', '2018-08-25 09:22:25', 'Yaroslavskaya', '935 Derek Center', 1, 25, 3, 2, true, true);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-01 21:50:52', '2018-06-02 15:15:58', '2018-05-25 21:08:36', 'Sam Ngam', '0 2nd Road', 2, 17, 3, 3, false, false);
insert into agreement (orderDate, approveDate, serviceDate, city, adress, squad, users, cleanLevel, services, approved, checked) values ('2018-09-29 13:32:18', '2018-01-28 06:32:21', '2018-01-01 09:22:36', 'Kyurdarmir', '9482 Anzinger Trail', 2, 30, 3, 1, true, false);
