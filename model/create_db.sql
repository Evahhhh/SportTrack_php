DROP TABLE "Data";
DROP TABLE "Activities";
DROP TABLE "User";

CREATE TABLE "User" (
	"idUser"	INTEGER,
	"lName"	TEXT NOT NULL,
	"fName"	TEXT NOT NULL,
	"birthDate"	TEXT NOT NULL,
	"gender"	TEXT NOT NULL CHECK("gender" = 'F' OR "gender" = 'M' OR "gender" = 'NB'),
	"size"	REAL NOT NULL,
	"weight"	REAL NOT NULL,
	"email"	TEXT NOT NULL UNIQUE,
	"password"	TEXT NOT NULL,
	PRIMARY KEY("idUser" AUTOINCREMENT)
);

CREATE TABLE "Activities" (
	"idAct"	INTEGER,
	"description"	TEXT NOT NULL,
	"date"	DATE NOT NULL,
	"startTime"	TEXT,
	"duration"	TEXT,
	"distance"	REAL,
	"cardiacFreqMin"	INTEGER,
	"cardiacFreqAvg"	INTEGER,
	"cardiacFreqMax"	INTEGER,
	"idUser"	TEXT,
	FOREIGN KEY("idUser") REFERENCES "User"("idUser"),
	PRIMARY KEY("idAct" AUTOINCREMENT)
);


CREATE TABLE "Data" (
	"idData"	INTEGER,
	"time" TEXT,
	"cardiacFreq" INTEGER,
	"longitude"	REAL,
	"latitude"	REAL,
	"altitude"	INTEGER,
	"idAct"	INTEGER NOT NULL,
	FOREIGN KEY("idAct") REFERENCES "Activities"("idAct"),
	PRIMARY KEY("idData" AUTOINCREMENT)
);