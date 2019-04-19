DROP DATABASE IF EXISTS laforge;

CREATE DATABASE laforge;

USE laforge;

CREATE TABLE User
(
	Id INT NOT NULL AUTO_INCREMENT
	, Username NVARCHAR(35) NOT NULL
	, Password NVARCHAR(100) NOT NULL
	, PRIMARY KEY (Id)
);

CREATE TABLE Category
(
	Id INT NOT NULL AUTO_INCREMENT
	, Name NVARCHAR(35) NOT NULL
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


INSERT INTO User (Username, Password)
VALUES ('Admin', 'n756JWnb');

INSERT INTO ExtendedProperty (Name, Value)
VALUES ('DBVersion', '1.00.000');

INSERT INTO Day (Id, Code)
VALUES (1, 'MONDAY')
, (2, 'TUESDAY')
, (3, 'WEDNESDAY')
, (4, 'THURSDAY')
, (5, 'FRIDAY')
, (6, 'SATURDAY')
, (7, 'SUNDAY');

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

INSERT INTO DayScheduleSection (Id, DayScheduleId, StartingTime, EndingTime)
VALUES (1, 2, '10:00', '12:00')
, (2, 2, '13:00', '19:00')
, (3, 3, '10:00', '12:00')
, (4, 3, '13:00', '19:00')
, (5, 4, '10:00', '12:00')
, (6, 4, '13:00', '19:00')
, (7, 5, '10:00', '12:00')
, (8, 5, '13:00', '19:00')
, (9, 6, '9:00', '12:00')
, (10, 6, '13:00', '19:00');

INSERT INTO Social (Id, FacebookLink, TwitterLink, YoutubeLink, InstagramLink)
VALUES (1, 'https://www.facebook.com/La-Forge-dAudren-164158920348705', 'https://twitter.com/LaForgedAudren', 'https://www.youtube.com/channel/UCuSOG6fpU1ymvx3yzbBrlUQ', 'https://www.instagram.com/renaudlepage/');

INSERT INTO Contact (Id, Email, Messenger, PhoneNumber)
VALUES (1, 'audren.forge@sfr.fr', 'https://m.me/164158920348705', '03.60.29.94.89');

INSERT INTO Address (Id, SocialReason, Line1, PostalCode, City)
VALUES (1, 'La Forge d''Audren', '6 rue Vincent de Beauvais', 60000, 'BEAUVAIS');

INSERT INTO Store (Id, AddressId, ContactId, SocialId, ScheduleId)
VALUES (1, 1, 1, 1, 1);