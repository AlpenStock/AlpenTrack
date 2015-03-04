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

		String esito = new String();
		for (int i = 0; i<descr.length; i++) {
				if(i==0){
					esito += descr[i][0] + "=" + descr[i][1];
				}else{
					esito += "\n" + descr[i][0] + "=" + descr[i][1];
				}
		}
		Filerw.writeContent("fonti.txt", esito);
	}
}