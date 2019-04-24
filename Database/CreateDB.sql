DROP DATABASE IF EXISTS laforge;

CREATE DATABASE laforge;

USE laforge;

CREATE TABLE Right
(
	Id INT NOT NULL AUTO_INCREMENT
	, Code NVARCHAR(10) NOT NULL
	, Label NVARCHAR(200) NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Role
(
	Id INT NOT NULL AUTO_INCREMENT
	, Label NVARCHAR(200) NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Role_Right
(
	RoleId INT NOT NULL
	, RightId INT NOT NULL
	, PRIMARY KEY (RoleId, RightId)
	, FOREIGN KEY (RoleId) REFERENCES Role(Id)
	, FOREIGN KEY (RightId) REFERENCES Right(Id)
);

CREATE TABLE User
(
	Id INT NOT NULL AUTO_INCREMENT
	, Username NVARCHAR(200) NOT NULL
	, Salt NVARCHAR(200) NOT NULL
	, Password NVARCHAR(200) NOT NULL
	, Email NVARCHAR(200) NOT NULL
	, RoleId INT NOT NULL
	, PRIMARY KEY (Id)
	, FOREIGN KEY (RoleId) REFERENCES Role(Id)
);

CREATE TABLE Category
(
	Id INT NOT NULL AUTO_INCREMENT
	, Name NVARCHAR(200) NOT NULL
	, Color BINARY(3) NOT NULL
	, IsVisible BOOLEAN NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Image
(
	Id INT NOT NULL AUTO_INCREMENT
	, Name NVARCHAR(35) NOT NULL
	, Extension NVARCHAR(10) NOT NULL
	, Path NVARCHAR(255) NOT NULL
	, IsVisible BOOLEAN NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Post
(
	Id INT NOT NULL AUTO_INCREMENT
	, Title NVARCHAR(100) NOT NULL
	, Slug NVARCHAR(100) NOT NULL
	, Description NVARCHAR(255) NOT NULL
	, Content TEXT NOT NULL
	, CreationDate DATETIME NOT NULL
	, LastUpdateDate DATETIME NOT NULL
	, IsPublished BOOLEAN NOT NULL
	, CategoryId INT NOT NULL
	, ImageId INT NOT NULL
	, PRIMARY KEY (Id)
	, FOREIGN KEY (CategoryId) REFERENCES Category(Id)
	, FOREIGN KEY (ImageId) REFERENCES Image(Id)
);

CREATE TABLE ExtendedProperty
(
	Id INT NOT NULL AUTO_INCREMENT
	, Name NVARCHAR(50) NOT NULL
	, Value NVARCHAR(255) NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Day
(
	Id INT NOT NULL AUTO_INCREMENT
	, Code NVARCHAR(10)
	, Label NVARCHAR(50)
	, PRIMARY KEY (Id)
);

CREATE TABLE Schedule
(
	Id INT NOT NULL AUTO_INCREMENT
	, PRIMARY KEY (Id)
);

CREATE TABLE DaySchedule
(
	Id INT NOT NULL AUTO_INCREMENT
	, ScheduleId INT NOT NULL
	, DayId INT NOT NULL UNIQUE
	, PRIMARY KEY (Id)
	, FOREIGN KEY (ScheduleId) REFERENCES Schedule(Id)
	, FOREIGN KEY (DayId) REFERENCES Day(Id)
);

CREATE TABLE DayScheduleSection
(
	Id INT NOT NULL AUTO_INCREMENT
	, DayScheduleId INT NOT NULL
	, StartingTime TIME NOT NULL
	, EndingTime TIME NOT NULL
	, PRIMARY KEY (Id)
	, FOREIGN KEY (DayScheduleId) REFERENCES DaySchedule(Id)
);

CREATE TABLE Social
(
	Id INT NOT NULL AUTO_INCREMENT
	, FacebookLink NVARCHAR(500) NULL
    , TwitterLink NVARCHAR(500) NULL
    , YoutubeLink NVARCHAR(500) NULL
    , InstagramLink NVARCHAR(500) NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Contact
(
	Id INT NOT NULL AUTO_INCREMENT
	, Email NVARCHAR(500) NULL
    , Messenger NVARCHAR(500) NULL
    , PhoneNumber NVARCHAR(20) NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Address
(
	Id INT NOT NULL AUTO_INCREMENT
	, SocialReason NVARCHAR(200) NOT NULL
	, Line1 NVARCHAR(200) NOT NULL
	, Line2 NVARCHAR(200) NULL
	, Line3 NVARCHAR(200) NULL
	, PostalCode INT NOT NULL
	, City NVARCHAR(200) NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Store
(
	Id INT NOT NULL AUTO_INCREMENT
	, AddressId INT NOT NULL
	, SocialId INT NOT NULL
	, ContactId INT NOT NULL
	, ScheduleId INT NOT NULL
	, PRIMARY KEY (Id)
	, FOREIGN KEY (AddressId) REFERENCES Address(Id)
	, FOREIGN KEY (SocialId) REFERENCES Social(Id)
	, FOREIGN KEY (ContactId) REFERENCES Contact(Id)
	, FOREIGN KEY (ScheduleId) REFERENCES Schedule(Id)
);



INSERT INTO Right (Id, Code, Label)
VALUES (1, 'MAN_USER', 'Gérer les utilisateurs')
, (2, 'MAN_POST', 'Gérer les articles')
, (3, 'MAN_CAT', 'Gérer les catégories')
, (4, 'MAN_STORE', 'Gérer les informations du magasin')
, (5, 'MAN_EVENT', 'Gérer les événements')
, (6, 'PROP_EVENT', 'Proposer des événements');

INSERT INTO Role (Id, Label)
VALUES (1, 'Administrateur')
, (2, 'Editeur')
, (3, 'Spectateur');

INSERT INTO Role_Right (RoleId, RightId)
VALUES (1, 1)
, (1, 2)
, (1, 3)
, (1, 4)
, (1, 5)
, (2, 2)
, (2, 3)
, (3, 6);

INSERT INTO User (Id, Username, Salt, Password, Email, RoleId)
VALUES (1, 'admin', '', '', 'admin@gmail.com', 1);

INSERT INTO ExtendedProperty (Name, Value)
VALUES ('DBVersion', '1.00.000');

INSERT INTO Day (Id, Code, Label)
VALUES (1, 'MONDAY', 'Lundi')
, (2, 'TUESDAY', 'Mardi')
, (3, 'WEDNESDAY', 'Mercredi')
, (4, 'THURSDAY', 'Jeudi')
, (5, 'FRIDAY', 'Vendredi')
, (6, 'SATURDAY', 'Samedi')
, (7, 'SUNDAY', 'Dimanche');

INSERT INTO Schedule (Id)
VALUES (1);

INSERT INTO DaySchedule (Id, ScheduleId, DayId)
VALUES (1, 1, 1)
, (2, 1, 2)
, (3, 1, 3)
, (4, 1, 4)
, (5, 1, 5)
, (6, 1, 6)
, (7, 1, 7);

INSERT INTO Social (Id, FacebookLink, TwitterLink, YoutubeLink, InstagramLink)
VALUES (1, 'www.facebook.com/La-Forge-dAudren-164158920348705', 'www.twitter.com/LaForgedAudren', 'www.youtube.com/channel/UCuSOG6fpU1ymvx3yzbBrlUQ', 'www.instagram.com/renaudlepage/');

INSERT INTO Contact (Id, Email, Messenger, PhoneNumber)
VALUES (1, 'audren.forge@sfr.fr', 'https://m.me/164158920348705', '03.60.29.94.89');

INSERT INTO Address (Id, SocialReason, Line1, PostalCode, City)
VALUES (1, 'La Forge d''Audren', '6 rue Vincent de Beauvais', 60000, 'BEAUVAIS');

INSERT INTO Store (Id, AddressId, ContactId, SocialId, ScheduleId)
VALUES (1, 1, 1, 1, 1);