import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
/*
La classe Filerw salva in un array di stringhe tutte le righe del file che corrispondono ai componenti del puzzle, sarà poi il metodo che chiama readContent a ricavarsi la struttura del componente che potrebbe cambiare, dal carattere di tabulazione a qualcos'altro
*/
public class Filerw{
  private static Charset charset = StandardCharsets.UTF_8;
	public static String[] readContent(String inputFile){
		Path inputPath = Paths.get(inputFile);
		StringBuilder content = new StringBuilder();
   	try (BufferedReader reader = Files.newBufferedReader(inputPath, charset)) {
   		String line = null;
      line = reader.readLine();
      if(line != null && line.length() > 0){
        content.append(line);
        while ((line = reader.readLine()) != null && line.length() > 0) {
          content.append('\n');
          content.append(line);
        }
      }
    }catch (IOException e) {
      System.err.println(e);
    }
    return content.toString().split("\n");
	}
   public static void writeContent(String outputFile, String content){
   	Path outputPath = Paths.get(outputFile);
   	try (BufferedWriter writer = Files.newBufferedWriter(outputPath, charset)) {
       writer.write(content);
    } catch (IOException e) {
       System.err.println(e);
    }
   }
}