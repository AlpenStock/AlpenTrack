DROP TABLE IF EXISTS ReqFonti;
DROP TABLE IF EXISTS Requisiti;
DROP TABLE IF EXISTS Fonti;
DROP TABLE IF EXISTS Credenziali;

CREATE TABLE Requisiti
(
	NomeReq VARCHAR(10),/*chiave troppo corta*/
	CodiceReq VARCHAR(10) NOT NULL, /*Si tratta del codice univoco, es. 1.1, non del nome completo (es. RC0F1.1) che verrà invece creato di volta in volta basandosi sui dati presenti nella tabella */
	Sistema VARCHAR(1) NOT NULL, /*C S oppure ""*/
	Importanza VARCHAR(1) NOT NULL, /* 0, 1 o 2 */
	Tipo VARCHAR(1) NOT NULL, /* F, V, Q o P*/
	Descrizione VARCHAR(500) NOT NULL,
	Soddisfatto BOOLEAN DEFAULT FALSE, 
	PRIMARY KEY (NomeReq)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Fonti
(
	NomeFonte VARCHAR(30) NOT NULL,
	DescrizioneFonte VARCHAR(500),
	PRIMARY KEY (NomeFonte)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE ReqFonti
(
	NomeReq VARCHAR(10),
	NomeFonte VARCHAR(30),
	PRIMARY KEY (NomeReq, NomeFonte),
	FOREIGN KEY (NomeReq) REFERENCES Requisiti(NomeReq) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (NomeFonte) REFERENCES Fonti(NomeFonte) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Credenziali
(
	Utente VARCHAR(20) NOT NULL,
	Password VARCHAR(30) NOT NULL,
	PRIMARY KEY (Utente)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;