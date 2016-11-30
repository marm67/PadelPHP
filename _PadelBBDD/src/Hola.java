import java.io.PrintWriter;

public class Hola {
	public static void main(String[] args) throws Exception {
	    PrintWriter writer = new PrintWriter("salida.txt");
	    writer.println("The first line");
	    writer.println("The second line");
	    writer.close();
	}	
}