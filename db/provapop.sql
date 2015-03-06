CALL inserisciRequisito(1,"C",0,"F","L'utente deve potersi registrare all'applicativo cloud",FALSE);
CALL inserisciRequisito(1.1,"C",0,"F","Ogni utente deve essere identificato da una email",FALSE);

CALL creaFonte("Interno","Origine interna del requisito");
CALL creaFonte("UCC1","Use case del sistema cloud numero 1");
CALL creaFonte("UCC1.1","Use case del sistema cloud numero 1.1");

INSERT INTO ReqFonti VALUES
("RC0F1","Interno"),
("RC0F1","UCC1"),
("RC0F1.1","Interno"),
("RC0F1.1","UCC1.1")
;