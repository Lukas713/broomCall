drop database IF EXISTS 1broomcall;

create database 1broomCall;

USE 1broomCall ;

CREATE TABLE squad 
(
    id INT NOT NULL primary key AUTO_INCREMENT,
    squadNumber INT,
    squadColor VARCHAR(15)
);


CREATE TABLE  users 
(
id INT NOT NULL primary key AUTO_INCREMENT,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phoneNumber VARCHAR(20)
);

CREATE TABLE services 
(
    id INT NOT NULL primary key AUTO_INCREMENT,
    serviceName VARCHAR(50) not NULL ,
    price DECIMAL(10,0) not NULL
);


CREATE TABLE cleanlevel 
(
    id INT NOT NULL primary key AUTO_INCREMENT,
    levelName VARCHAR(20),
    priceCoeficient decimal(10,2)
);

CREATE TABLE agreement (
  id INT NOT NULL primary key AUTO_INCREMENT,
  serviceDate DATETIME,
  city VARCHAR(20),
  adress VARCHAR(50),
  squad INT,
  users INT,
  cleanLevel INT,
  services int
);

CREATE TABLE department 
(
  id INT NOT NULL primary key AUTO_INCREMENT,
  depName VARCHAR(20)
);

CREATE TABLE employees
 (
  id INT NOT NULL primary key AUTO_INCREMENT,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phoneNumber VARCHAR(20) NOT NULL,
  city VARCHAR(50) NOT NULL,
  zipCode VARCHAR(50) NOT NULL,
  adress VARCHAR(50) NOT NULL,
  oib VARCHAR(15) NOT NULL,
  IBAN VARCHAR(50) NOT NULL,
  passwrd VARCHAR(50) NOT NULL,
  squad INT,
  department INT
  );

  alter table employees add foreign key(squad) references squad(id);
  alter table employees add foreign key(department) references department(id);

  alter table agreement add foreign key(squad) references squad(id);
  alter table agreement add foreign key(services) references services(id);
  alter table agreement add foreign key(cleanLevel) references cleanLevel(id);
  alter table agreement add foreign key(users) references users(id);

insert into squad(id, squadNumber, squadColor) values 
(null, 1, "#256645"),
(null, 2, "#AA0000"),
(null, 3, "#0000FF");

insert into department(id, depName) values 
(null, "Cleaners"),
(null, "Logistics"),
(null, "Administration"),
(null, "Technics");

insert into services(id, serviceName, price) values 
(null, "1 bedroom", 100),
(null, "2 bedroom", 200),
(null, "3 bedroom", 300);

insert into cleanLevel(id, levelName, priceCoeficient) values 
(null, "Regular", 1.00),
(null, "Deep cleaning", 1.45),
(null, "Move in/out", 1.75);


insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (1, 'Lela', 'Heaton', 'lheaton0@yellowpages.com', '124-195-3649', 'Nykarleby', '48-6667515', '95 Sundown Crossing', '60-528-4798', 'FR32 6552 0976 24FC E5QO 1R1J C68', 'XIgLLtiK', 1, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (2, 'Vasily', 'Braune', 'vbraune1@sciencedirect.com', '329-238-8152', 'Donja Brela', '57-8771373', '89 Texas Plaza', '20-435-1335', 'TR17 7750 4BZA FLPS OROO OFU7 GI', 'AKmV1X6U', 1, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (3, 'Dione', 'Cornick', 'dcornick2@blog.com', '654-458-8720', 'Črenšovci', '60-8703227', '1119 Garrison Street', '56-391-2590', 'AT16 0995 3130 5727 4113', 'dZMf8GVqI2Vw', 2, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (4, 'Perren', 'Roubottom', 'proubottom3@nbcnews.com', '414-206-6770', 'Basel', '14-0329413', '026 Straubel Plaza', '20-433-0512', 'FO23 3193 9817 0017 44', 'NXNL64snd', 2, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (5, 'Jerrilyn', 'Valance', 'jvalance4@sogou.com', '877-468-7718', 'Haradzishcha', '46-1886136', '0132 Sullivan Avenue', '08-408-5585', 'IL29 5321 3848 5373 8174 910', 'WDLyI4O313bv', 2, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (6, 'Devora', 'Garber', 'dgarber5@washington.edu', '807-528-1885', 'Hushan', '73-2111205', '9 Sundown Park', '36-679-1811', 'IE83 RMXW 5483 9051 4861 38', 'LbCIMCHx8Ipj', 2, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (7, 'Archie', 'Robel', 'arobel6@statcounter.com', '795-351-9238', 'Sujiatun', '60-8392105', '6583 Jay Parkway', '15-764-8232', 'PL32 0915 8215 0414 3504 0879 4985', 'c3FbSJ', 1, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (8, 'Pauly', 'Lacelett', 'placelett7@irs.gov', '949-140-5073', 'Jindong', '05-2811657', '7 Shopko Avenue', '93-108-9313', 'MT76 AGDK 3601 1R8W PW50 NHOM SZTQ RIL', 'xs1cO3dVsL', 2, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (9, 'Jefferson', 'Gorioli', 'jgorioli8@springer.com', '481-930-3497', 'Stockholm', '88-4761372', '17 Calypso Lane', '60-764-9140', 'DO51 YPIA 2342 9137 8855 6677 6562', 'sOvyYZQ', 2, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (10, 'Augustus', 'Corner', 'acorner9@home.pl', '919-218-8481', 'San Jose', '98-4933853', '3 Judy Circle', '60-496-7613', 'FO03 6751 6297 2131 23', 'v3WRgQ9Dm', 1, 1);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (11, 'Bruis', 'Hungerford', 'bhungerforda@wunderground.com', '506-742-8150', 'Kulaman', '53-5718391', '596 Browning Road', '01-552-6185', 'BA88 9593 7581 2958 5247', 'Zyq31V', 1, 2);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (12, 'Neil', 'Conway', 'nconwayb@google.nl', '615-331-2781', 'Kandy', '87-8944898', '10803 Kenwood Junction', '90-895-8480', 'IL36 1003 5078 4162 2589 972', '16Y94eJv2dm', 1, 3);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (13, 'Sandy', 'Healing', 'shealingc@hhs.gov', '172-846-9131', 'Nyagan', '08-4241934', '17 Graceland Way', '55-885-8213', 'KZ55 336A 1YWZ EXVS 28YB', 'ogmxXC2Fvd', 2, 4);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (14, 'Valaree', 'L''Archer', 'vlarcherd@qq.com', '335-729-3380', 'Huzhen', '94-2791312', '28 Fuller Point', '17-336-5098', 'KZ74 983I WLGW LOAT IUYY', 'iH6tvW6qcL', 1, 2);
insert into employees (id, firstName, lastName, email, phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, squad, department) values (15, 'Ellery', 'D''Cruze', 'edcruzee@tripadvisor.com', '483-235-7196', 'Cerro Blanco', '25-5523567', '2 Swallow Crossing', '88-591-5001', 'GB95 XLKB 4944 7922 1373 75', 'lkcRIfUs', 2, 3);

insert into users (id, firstName, lastName, email, phoneNumber) values (1, 'Adriana', 'Marriott', 'amarriott0@jigsy.com', '588-649-0682');
insert into users (id, firstName, lastName, email, phoneNumber) values (2, 'Frannie', 'Girkins', 'fgirkins1@issuu.com', '527-521-6413');
insert into users (id, firstName, lastName, email, phoneNumber) values (3, 'Annabella', 'Earsman', 'aearsman2@mediafire.com', '385-169-0458');
insert into users (id, firstName, lastName, email, phoneNumber) values (4, 'Freedman', 'Busswell', 'fbusswell3@zdnet.com', '248-368-9009');
insert into users (id, firstName, lastName, email, phoneNumber) values (5, 'Cinda', 'Hawkswell', 'chawkswell4@alexa.com', '478-520-1881');
insert into users (id, firstName, lastName, email, phoneNumber) values (6, 'Jimmy', 'Sherreard', 'jsherreard5@360.cn', null);
insert into users (id, firstName, lastName, email, phoneNumber) values (7, 'Robinette', 'Paris', 'rparis6@wsj.com', null);
insert into users (id, firstName, lastName, email, phoneNumber) values (8, 'Jo-anne', 'Willmetts', 'jwillmetts7@pbs.org', '679-807-4907');
insert into users (id, firstName, lastName, email, phoneNumber) values (9, 'Raymund', 'Oxenden', 'roxenden8@smh.com.au', null);
insert into users (id, firstName, lastName, email, phoneNumber) values (10, 'Darda', 'Beckers', 'dbeckers9@bloomberg.com', null);
insert into users (id, firstName, lastName, email, phoneNumber) values (11, 'Lily', 'Blagden', 'lblagdena@dedecms.com', null);
insert into users (id, firstName, lastName, email, phoneNumber) values (12, 'Georgena', 'Caudle', 'gcaudleb@chicagotribune.com', null);
insert into users (id, firstName, lastName, email, phoneNumber) values (13, 'Noak', 'Studd', 'nstuddc@simplemachines.org', '649-173-5794');
insert into users (id, firstName, lastName, email, phoneNumber) values (14, 'Kevon', 'Billie', 'kbillied@microsoft.com', '452-385-6782');
insert into users (id, firstName, lastName, email, phoneNumber) values (15, 'Bernadine', 'Calveley', 'bcalveleye@barnesandnoble.com', '362-995-7826');