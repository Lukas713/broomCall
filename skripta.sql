drop database if exists 1broomCall;

create database 1broomCall;

use 1broomCall;

create table korisnik
	(
		id int primary key not null auto_increment,
		ime varchar(50) not null,
		prezime varchar(50) not null,
		username varchar(50) not null,
		oib int(20),
		email varchar(50) not null,
		mobitel varchar(50),
		ponuda int,
		potraznja int
	);

create table potraznja
	(
		id int primary key not null auto_increment,
		grad varchar(50) not null,
		adresa varchar(50) not null,
		opis text not null,
		razina_prljavstine int
	);

create table ponuda
	(
		id int primary key not null auto_increment,
		grad varchar(50) not null,
		ziro_racun varchar(20) not null
	);

create table dogovor
	(
		id int primary key not null auto_increment,
		vrijeme_zavrsetka datetime,
		ocjena int,
		komentar text,
		vrijeme_placanja datetime,
		ponuda int,
		potraznja int
	);

create table racun
	(
		id int primary key not null auto_increment,
		dogovor int,
		vrijeme_pocetka_rada datetime,
		vrijeme_izdatka datetime,
		cijena decimal(18,2)
	);

alter table korisnik add foreign key (potraznja) references potraznja(id);

alter table korisnik add foreign key (ponuda) references ponuda(id);

alter table dogovor add foreign key (ponuda) references ponuda(id);
alter table dogovor add foreign key (potraznja) references potraznja(id);


alter table racun add foreign key (dogovor) references dogovor(id) ;

