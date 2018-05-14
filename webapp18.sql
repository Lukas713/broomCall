drop database if exists break_tracker18;

create database break_tracker18;

use break_tracker18;

create table objekt
	(
		id int not null primary key auto_increment,
		naziv varchar(50) not null,
		mjesto int,
		longitude decimal(10,6) not null,
		latitude decimal(10,6) not null
	);

create table mjesto 
	(
		id int not null primary key auto_increment,
		naziv varchar(50),
		longitude decimal(10,6),
		latitude decimal(10,6)
	);

create table korisnik
	(
		id int not null primary key auto_increment,
		username varchar(50) not null,
		email varchar(50) not null,
		longitute decimal(10,6),
		latitude decimal(10,6)
	);

create table objekt_korisnik 
	(
		objekt int,
		korisnik int,
		komentar varchar(255),
		ocjena varchar(10)
	);

create table djelatnost 
	(
		id int not null primary key auto_increment,
		naziv varchar(50) not null
	);

create table djelatnost_objekt
	(
		djelatnost int,
		objekt int
	);

alter table objekt add foreign key (mjesto) references mjesto(id);

alter table objekt_korisnik add foreign key(objekt) references objekt(id);
alter table objekt_korisnik add foreign key(korisnik) references korisnik(id);

alter table djelatnost_objekt add foreign key(djelatnost) references djelatnost(id);
alter table djelatnost_objekt add foreign key(objekt) references objekt(id);

insert into mjesto(id, naziv, longitude, latitude) values
(null, 'Osijek', 18.69550729, 45.55474485),
(null, 'Đakovo', 18.41398264, 45.3138266),
(null, 'Vinkovci', 18.80811716, 45.28388106);

insert into djelatnost(id, naziv) values
(null, 'caffe bar'),
(null, 'night club'),
(null, 'restoran');

insert into objekt(id, naziv, mjesto, longitude, latitude) values
(null, 'Corner', 1, 18.7284107, 45.54563262),
(null, 'Hokus Okus', 1, 18.67636621, 45.55841507),
(null, 'Kruz', 2, 18.40735951, 45.31561158);




