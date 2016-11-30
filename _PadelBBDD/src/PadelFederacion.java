import java.io.*;
import java.util.ArrayList;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class PadelFederacion {

    public static void main(String[] args) throws Exception {
        System.out.println("Hola mundo");
        crearFichero();
    }

    private static void crearFichero() throws Exception {
        PrintWriter pw = new PrintWriter(new File("hola.txt" ));
        pw.write("Hola mundo");
        pw.close();        
    }

	private static final String url = "http://www.padelfederacion.es/";

	public static List<Torneo> getTorneos() throws Exception {
		String ano = "2016";
		String tipo = "MENORES";
		String modalidad = "PAREJAS";
		
		return getTorneos(ano, tipo, modalidad);
	}
	
	public static List<Torneo> getTorneos(String ano, String tipo, String modalidad) throws Exception {
		String pagina = url + "Paginas/padelmadrid/pruebas.asp";
		List<Torneo> torneos = new ArrayList<Torneo>();
		Document doc = Jsoup.connect(pagina).data("ano", ano).data("tipo", tipo).data("modalidad", modalidad)
				.userAgent("Mozilla").post();
		Elements trs = doc.select("table tbody tr");
		for (Element tr : trs) {
			Elements tds = tr.select("td");
			if( tds.size() >= 6 ) {
				String del = tds.get(0).text();
				String al = tds.get(1).text();
				String torneo = tds.get(2).text();
				String idTorneo = tds.get(2).select("a").attr("href").split("=")[1];
				String categoria = tds.get(3).text();
				String lugar = tds.get(5).text();
				String sede = tds.get(6).text();
				Torneo t = new Torneo(idTorneo, del, al, torneo, categoria, lugar, sede);
				torneos.add(t);
			}
		}
		return torneos;
	}
}
