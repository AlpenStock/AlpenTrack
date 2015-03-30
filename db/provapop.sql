INSERT INTO Credenziali(Utente, Password) 
VALUES ("Admin", "alpenstockadmin");

INSERT INTO Requisiti VALUES
("RC0F1",1,"C",0,"F","L'utente deve potersi registrare all'applicativo cloud",FALSE),
("RC0F1.1",1.1,"C",0,"F","Ogni utente deve essere identificato da una email",FALSE)
;

INSERT INTO Fonti VALUES
("Interno","Origine interna del requisito"),
("UCC1","Use case del sistema cloud numero 1"),
("UCC1.1","Use case del sistema cloud numero 1.1");

INSERT INTO ReqFonti VALUES
("RC0F1","Interno"),
("RC0F1","UCC1"),
("RC0F1.1","Interno"),
("RC0F1.1","UCC1.1")
;

INSERT INTO Componenti VALUES
("CapaVilla"),
("Cavallino")
;

INSERT INTO ReqComp VALUES
("RC0F1","CapaVilla"),
("RC0F1.1","CapaVilla"),
("RC0F1.1","Cavallino")
;