import java.util.ArrayList;
public class DescFonti{
	public static void main(String[] args){
		String[] input = Filerw.readContent("AnalisiDeiRequisiti_v1.0.0.tex");
		ArrayList<String> fonti = new ArrayList<String>();
		for (int i = 0; i<input.length; i++) {
			if(input[i].length() > 25 && input[i].substring(0,25).equals("\\subsection{Caso d'uso UC")){
				fonti.add(input[i]);
			}
		}
		String[][] descr = new String[fonti.size()][2];
		for(int i=0; i<fonti.size();i++){
			descr[i] = fonti.get(i).substring(23).split(":");
			descr[i][0] = descr[i][0].trim();
			descr[i][1] = descr[i][1].trim().replace("}", "");
		}
		String fonti_out = "INSERT INTO Fonti VALUES ";
		for(int i = 0; i<descr.length; i++){
			if(i == 0){
				fonti_out += "(";
			}else{
				fonti_out += ",\n(";
			}
			for(int j = 0; j < descr[i].length; j++) {
				if(j != 0){
					fonti_out += ", ";
				}
				fonti_out += "\"" + descr[i][j] + "\"";
			}
			fonti_out += ")";
		}
		fonti_out += ",\n(\"Interno\", \"\")";
		fonti_out += ",\n(\"Capitolato\", \"\")";
		fonti_out += ",\n(\"Verbale\\_3\", \"\")";
		fonti_out += ";";
		Filerw.writeContent("Fonti.sql", fonti_out);
	}
}