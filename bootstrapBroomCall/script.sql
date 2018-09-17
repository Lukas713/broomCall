drop database IF EXISTS 1broomcall;

create database 1broomCall;

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
    email varchar(50) not null 
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
  serviceDate DATETIME,
  city VARCHAR(20),
  adress VARCHAR(50),
  squad INT,
  users INT,
  cleanLevel INT,
  services int,
  approved boolean
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
  passwrd VARCHAR(50),
  person int,
  squad INT,
  department INT
  );

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

insert into person (firstName, lastName, email) values ('Garald', 'Glyde', 'gglyde0@canalblog.com');
insert into person (firstName, lastName, email) values ('Engelbert', 'Andersch', 'eandersch1@census.gov');
insert into person (firstName, lastName, email) values ('Janos', 'Leggan', 'jleggan2@addthis.com');
insert into person (firstName, lastName, email) values ('Shay', 'Brilleman', 'sbrilleman3@nba.com');
insert into person (firstName, lastName, email) values ('Lanna', 'Glanester', 'lglanester4@seesaa.net');
insert into person (firstName, lastName, email) values ('Gilberte', 'Franchyonok', 'gfranchyonok5@csmonitor.com');
insert into person (firstName, lastName, email) values ('Abel', 'Merriment', 'amerriment6@comsenz.com');
insert into person (firstName, lastName, email) values ('Joann', 'Faulconbridge', 'jfaulconbridge7@wp.com');
insert into person (firstName, lastName, email) values ('Amandi', 'Cereceres', 'acereceres8@bloglovin.com');
insert into person (firstName, lastName, email) values ('Goldi', 'Slayton', 'gslaytonc@nydailynews.com');
insert into person (firstName, lastName, email) values ('Yule', 'Reynoollds', 'yreynoolldse@businessinsider.com');
insert into person (firstName, lastName, email) values ('Melamie', 'Titman', 'mtitmanf@merriam-webster.com');
insert into person (firstName, lastName, email) values ('Frasquito', 'Baraja', 'fbarajag@1und1.de');
insert into person (firstName, lastName, email) values ('Neddie', 'Hainsworth', 'nhainsworthh@whitehouse.gov');
insert into person (firstName, lastName, email) values ('Mabel', 'Durrance', 'mdurrancei@elegantthemes.com');
insert into person (firstName, lastName, email) values ('Debee', 'Ceaplen', 'dceaplenj@a8.net');
insert into person (firstName, lastName, email) values ('Sheffy', 'Tremathack', 'stremathackk@fda.gov');
insert into person (firstName, lastName, email) values ('Ronny', 'Klamman', 'rklammanl@utexas.edu');
insert into person (firstName, lastName, email) values ('Thorstein', 'Brahms', 'tbrahmsm@ocn.ne.jp');
insert into person (firstName, lastName, email) values ('Adorne', 'Jeffels', 'ajeffelsn@discovery.com');
insert into person (firstName, lastName, email) values ('Felic', 'Karet', 'fkareto@qq.com');
insert into person (firstName, lastName, email) values ('Electra', 'Cory', 'ecoryp@apache.org');
insert into person (firstName, lastName, email) values ('Herve', 'Cluderay', 'hcluderayq@de.vu');
insert into person (firstName, lastName, email) values ('Derrek', 'Zecchini', 'dzecchinir@berkeley.edu');
insert into person (firstName, lastName, email) values ('Shayne', 'Bradman', 'sbradmans@npr.org');
insert into person (firstName, lastName, email) values ('Rosaleen', 'Tompsett', 'rtompsettt@miitbeian.gov.cn');
insert into person (firstName, lastName, email) values ('Omero', 'Garlinge', 'ogarlingeu@ezinearticles.com');
insert into person (firstName, lastName, email) values ('Minnie', 'Sidworth', 'msidworthv@amazon.com');
insert into person (firstName, lastName, email) values ('Algernon', 'Fritschel', 'afritschelw@booking.com');
insert into person (firstName, lastName, email) values ('Sherline', 'Christoffe', 'schristoffex@4shared.com');
insert into person (firstName, lastName, email) values ('Teena', 'Stygall', 'tstygally@ibm.com');
insert into person (firstName, lastName, email) values ('Maryellen', 'McCaughran', 'mmccaughranz@marketwatch.com');
insert into person (firstName, lastName, email) values ('Maddy', 'Souch', 'msouch10@t-online.de');
insert into person (firstName, lastName, email) values ('Horacio', 'Bramstom', 'hbramstom11@earthlink.net');
insert into person (firstName, lastName, email) values ('Goldi', 'Clawsley', 'gclawsley12@wix.com');
insert into person (firstName, lastName, email) values ('Kora', 'Bouldstridge', 'kbouldstridge13@disqus.com');
insert into person (firstName, lastName, email) values ('Georas', 'Poacher', 'gpoacher14@businessinsider.com');
insert into person (firstName, lastName, email) values ('Jannelle', 'Stride', 'jstride15@elpais.com');
insert into person (firstName, lastName, email) values ('Karlyn', 'Mulheron', 'kmulheron16@biglobe.ne.jp');
insert into person (firstName, lastName, email) values ('Agosto', 'Vondrys', 'avondrys17@phpbb.com');
insert into person (firstName, lastName, email) values ('Kaitlin', 'Hitzmann', 'khitzmann18@nps.gov');
insert into person (firstName, lastName, email) values ('Marybelle', 'Cuthbertson', 'mcuthbertson19@xinhuanet.com');
insert into person (firstName, lastName, email) values ('Graig', 'Pittham', 'gpittham1a@friendfeed.com');
insert into person (firstName, lastName, email) values ('Chrisse', 'Orr', 'corr1b@princeton.edu');
insert into person (firstName, lastName, email) values ('Alice', 'Plumer', 'aplumer1c@tuttocitta.it');
insert into person (firstName, lastName, email) values ('Josh', 'Cottu', 'jcottu1d@about.com');

insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('313-372-5137', 'Kresna', '2833', '75995 Grover Parkway', '15-3981673', 'PL17 4645 4069 2937 0502 6385 9072', 'TjEY0See', 14, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('470-249-8889', 'Tualangcut', '2833', '3 Erie Center', '09-1795687', 'PL81 0279 9333 2850 7568 5455 5960', 'ishoie', 9, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('260-653-6154', 'Whittlesea', '5630', '091 Susan Way', '56-0993407', 'FR85 9084 6633 13N9 FSNL JJ3T N77', 'Df31DG0H', 8, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('718-688-2165', 'Ulme', '2140-368', '38937 Anhalt Crossing', '38-3129012', 'DO49 R3QG 5822 3303 2602 5304 9740', 'rxC6MF7u25q', 7, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('334-831-9691', 'Lowayu', '2833', '78 Prentice Plaza', '18-1847964', 'FR18 1023 5086 715C SNYY YTUO I53', 'i2KJ29Mhq', 6, 1, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('795-873-0910', 'Cañuelas', '1814', '7 6th Hill', '32-8648153', 'PS71 ZPLH AGPX JGBL HLUE UMHO GK8L 1', 'eTW6wSV', 5, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('246-377-5246', 'Songbai', '2833', '6490 Arapahoe Drive', '08-8750357', 'SE03 6691 0767 7276 4041 5938', '8R04DsAV', 4, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('175-338-8832', 'Varakļāni', '2833', '1042 American Ash Junction', '54-6079757', 'FR35 1984 2328 56ZZ JL3J FLFE Q85', '2tuUJkt0', 3, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('473-212-7072', 'Bueng Kan', '34140', '16755 Oak Place', '79-0518137', 'IE11 HYAU 7840 4733 4058 16', 'UbSv6Xm', 2, 2, 1);
insert into employees (phoneNumber, city, zipCode, adress, oib, IBAN, passwrd, person, squad, department) values ('264-994-8129', 'Jinhai', '2833', '48 Autumn Leaf Crossing', '20-8155328', 'FR51 7300 7033 17XC 7BYQ GJSA V73', 'e1ELG8lhoq', 1, 2, 1);

insert into users (id, phoneNumber, person) values (1, '793-974-4612', 16);
insert into users (id, phoneNumber, person) values (2, '757-230-9740', 17);
insert into users (id, phoneNumber, person) values (3, '443-216-2453', 18);
insert into users (id, phoneNumber, person) values (4, '167-683-0537', 19);
insert into users (id, phoneNumber, person) values (5, '155-240-4530', 20);
insert into users (id, phoneNumber, person) values (6, '108-355-9675', 21);
insert into users (id, phoneNumber, person) values (7, '437-745-0466', 22);
insert into users (id, phoneNumber, person) values (8, '428-213-1999', 23);
insert into users (id, phoneNumber, person) values (9, '917-453-4579', 24);
insert into users (id, phoneNumber, person) values (10, '221-995-0051', 25);
insert into users (id, phoneNumber, person) values (11, '993-494-3020', 26);
insert into users (id, phoneNumber, person) values (12, '797-250-2745', 27);
insert into users (id, phoneNumber, person) values (13, '372-813-4176', 28);
insert into users (id, phoneNumber, person) values (14, '198-431-5360', 29);
insert into users (id, phoneNumber, person) values (15, '294-581-5151', 30);
insert into users (id, phoneNumber, person) values (16, '443-761-8262', 31);
insert into users (id, phoneNumber, person) values (17, '898-474-2652', 32);
insert into users (id, phoneNumber, person) values (18, '521-929-2252', 33);
insert into users (id, phoneNumber, person) values (19, '934-262-5173', 34);
insert into users (id, phoneNumber, person) values (20, '923-697-4058', 35);
insert into users (id, phoneNumber, person) values (21, '507-690-1430', 36);
insert into users (id, phoneNumber, person) values (22, '195-491-6187', 37);
insert into users (id, phoneNumber, person) values (23, '535-220-9891', 38);
insert into users (id, phoneNumber, person) values (24, '592-381-5664', 39);
insert into users (id, phoneNumber, person) values (25, '362-115-0721', 40);
insert into users (id, phoneNumber, person) values (26, '676-693-4846', 41);


insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-07-03 13:13:49', 'Ilyich', '2 Northport Court', 1, 15, 1, 1, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-08-09 06:46:17', 'Benniu', '9 Rockefeller Way', 2, 10, 2, 1, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-06-14 13:30:50', 'Clarin', '63 Mitchell Park', 1, 4, 1, 3, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-07-09 11:24:22', 'Parung', '21 Elmside Pass', 2, 6, 2, 1, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-07-19 02:36:32', 'Kariaí', '54 Sutteridge Hill', 2, 13, 3, 2, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-01-06 06:48:06', 'San Jose', '1 Coolidge Plaza', 2, 13, 3, 3, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-02-19 14:25:31', 'Šid', '34301 Norway Maple Trail', 1, 13, 3, 1, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-04-20 22:21:48', 'Cagayan', '46714 Stoughton Drive', 2, 4, 3, 2, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-08-18 02:30:13', 'Eixo', '4595 Dapin Crossing', 1, 14, 3, 3, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-06-17 10:59:48', 'Xiaxindian', '15 Troy Terrace', 1, 20, 2, 1, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2017-12-15 15:03:57', 'Bayanbaogede', '9 Vera Point', 2, 24, 1, 3, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-05-01 16:34:20', 'Calaba', '187 Marquette Pass', 1, 7, 2, 3, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-04-24 18:42:59', 'Ribnica na Pohorju', '96 Nancy Terrace', 1, 22, 1, 3, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-05-21 08:39:19', 'Nova Friburgo', '46 Scofield Alley', 1, 12, 2, 1, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-07-09 01:21:57', 'Крива Паланка', '02962 Lighthouse Bay Terrace', 1, 6, 1, 1, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-03-17 11:55:17', 'Chełm', '9 Mesta Avenue', 2, 11, 1, 1, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-06-12 21:50:32', 'Betaf', '9957 Bunting Hill', 2, 5, 1, 3, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-07-01 16:55:47', 'Saukkola', '11237 Gale Lane', 1, 17, 3, 2, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2017-10-31 00:09:01', 'Wanmu', '5 Ronald Regan Plaza', 2, 9, 3, 3, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-05-05 13:35:53', 'Lansing', '36 Doe Crossing Terrace', 2, 2, 3, 1, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-08-05 09:19:11', 'Brasília', '60 Cambridge Street', 1, 15, 3, 2, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-01-16 15:02:05', 'Jönköping', '4 Porter Lane', 1, 1, 2, 1, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-08-23 11:05:45', 'Retorta', '3 Oneill Point', 1, 2, 2, 2, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-09-09 18:11:42', 'Bondowoso', '9 Talmadge Court', 1, 14, 3, 3, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-01-03 11:27:55', 'Trondheim', '322 Claremont Hill', 2, 22, 3, 2, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2017-11-03 08:36:43', 'Shibli', '184 Melvin Park', 1, 15, 3, 2, true);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-02-08 22:48:26', 'Gao’an', '32134 Bellgrove Alley', 2, 15, 1, 2, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-08-23 15:04:02', 'Eiriz', '83668 Acker Point', 2, 7, 3, 3, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2017-09-15 19:10:06', 'Curug', '74 Rigney Parkway', 2, 1, 2, 2, false);
insert into agreement (serviceDate, city, adress, squad, users, cleanLevel, services, approved) values ('2018-07-15 12:53:15', 'Modimolle', '3049 Shoshone Park', 1, 3, 3, 1, false);

