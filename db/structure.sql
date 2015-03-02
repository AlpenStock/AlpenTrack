DROP TABLE IF EXISTS Requisiti
CREATE TABLE Requisiti
{
	NomeReq VARCHAR(10) NOT NULL,
	CodiceReq VARCHAR(10) NOT NULL, /*Si tratta del codice univoco, es. 1.1, non del nome completo (es. RC0F1.1) che verrà invece creato 
									  di volta in volta basandosi sui dati presenti nella tabella */
	Sistema VARCHAR(1) NOT NULL,
	Importanza VARCHAR(1) NOT NULL,
	Tipo VARCHAR(1) NOT NULL,
	Descrizione VARCHAR(200) NOT NULL,
	Soddisfatto BOOLEAN DEFAULT 'FALSE'     
	PRIMARY KEY (NomeReq)
} ENGINE = InnoDB;

DROP TABLE IF EXISTS Fonti
CREATE TABLE Fonti
{
	NomeFonte VARCHAR(30) NOT NULL,
	DescrizioneFonte VARCHAR(30),
	PRIMARY KEY (NomeFonte)
} ENGINE = InnoDB;

DROP TABLE IF EXISTS ReqFonti 
CREATE TABLE ReqFonti
{
	NomeReq VARCHAR(10),
	NomeFonte VARCHAR(30),
	PRIMARY KEY (NomeReq, NomeFonte),
	FOREIGN KEY (NomeReq) REFERENCES Requisiti(NomeReq) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (NomeFonte) REFERENCES Fonti(NomeFonte) ON DELETE CASCADE ON UPDATE CASCADE,
} ENGINE = InnoDB;