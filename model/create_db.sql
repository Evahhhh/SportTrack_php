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
	"email"	TEXT NOT NULL 
		CONSTRAINT "uq_email" UNIQUE,
	"password"	TEXT NOT NULL,
	CONSTRAINT "pk_User" PRIMARY KEY("idUser" AUTOINCREMENT)
);

CREATE TABLE "Activities" (
	"idAct"	INTEGER,
	"description"	TEXT NOT NULL,
	"date"	TEXT NOT NULL,
	"idUser"	TEXT,
	CONSTRAINT "fk_Activites_User" FOREIGN KEY("idUser") REFERENCES "User"("idUser"),
	CONSTRAINT "pk_Activities" PRIMARY KEY("idAct" AUTOINCREMENT)
);


CREATE TABLE "Data" (
	"idData"	INTEGER,
	"startTime"	TEXT,
	"duration"	TEXT,
	"distance"	INTEGER,
	"cardiacFreqMin"	INTEGER,
	"cardiacFreqAvg"	INTEGER,
	"cardiacFreqMax"	INTEGER,
	"longitude"	REAL,
	"latitude"	REAL,
	"altitude"	INTEGER,
	"idAct"	INTEGER NOT NULL,
	CONSTRAINT "fk_Data_Activities" FOREIGN KEY("idAct") REFERENCES "Activities"("idAct"),
	CONSTRAINT "pk_Data" PRIMARY KEY("idData" AUTOINCREMENT)
);