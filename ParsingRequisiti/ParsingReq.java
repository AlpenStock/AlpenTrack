public class ParsingReq{
	public static void main(String args[]){
		if(args.length < 1){
			System.out.println("file di input non inserito!");
		}else{
			String[] input = Filerw.readContent(args[0]);
			String[][] req = new String[input.length][3];
			for (int i = 0; i < input.length ;i++ ) {
				input[i] = input[i].trim();
				req[i] = input[i].split("&");
				req[i][0] = req[i][0].trim();
				req[i][1] = req[i][1].trim();
				req[i][2] = req[i][2].trim();
			}
			String[][] requisiti = new String[req.length][6];
			int k = 1;
			String aux;
			for (int i = 0; i < req.length; i++) {
				requisiti[i][0] = req[i][0]; //nome requisito (RC0F1.1)
				aux = req[i][0].substring(k, k+1); //sistema
				if(aux.equals("S") || aux.equals("C")){
					requisiti[i][2] = aux;
					k++;
				}else{
					requisiti[i][2] = "";
				}
				requisiti[i][3] = req[i][0].substring(k, k+1); //importanza
				k++;
				requisiti[i][4] = req[i][0].substring(k, k+1); //tipo
				k++;
				requisiti[i][1] = req[i][0].substring(k); //codice
				requisiti[i][5] = req[i][1]; //descrizione
				k = 1;
			}
			//Tabella requisiti
			String tabreq = "INSERT INTO Requisiti(NomeReq, CodiceReq, Sistema, Importanza, Tipo, Descrizione) VALUES ";
			for(int i = 0; i<requisiti.length;i++){
				if(i == 0){
					tabreq += "(";
				}else{
					tabreq += ",\n(";
				}
				for(int j = 0; j < requisiti[i].length; j++) {
					if(j != 0){
						tabreq += ", ";
					}
					tabreq += "\"" + requisiti[i][j] + "\"";
				}
				tabreq += ")";
			}
			tabreq += ";";
			Filerw.writeContent("Requisiti.sql", tabreq);
		}
	}
}