import java.util.ArrayList;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class Torneo {
	private static final String url = "http://www.padelfederacion.es/Paginas/padelmadrid/Prueba_Inscritos.asp";
	
	private String idTorneo;
	private String del;
	private String al;
	private String torneo;
	private String categoria;
	private String lugar;
	private String sede;
	
	public Torneo(String idTorneo, String del, String al, String torneo, String categoria, String lugar, String sede) {
		super();
		this.idTorneo = idTorneo;
		this.del = del;
		this.al = al;
		this.torneo = torneo;
		this.categoria = categoria;
		this.lugar = lugar;
		this.sede = sede;
	}

	public String toString() {
        return "Torneo\n  " 
                + "idTorneo : " + this.idTorneo + "\n  "
                + "Del      : " + this.del + "\n  "
                + "Al       : " + this.al + "\n  "
                + "Torneo   : " + this.torneo + "\n  "
                + "Categoria: " + this.categoria + "\n  "
                + "Lugar    : " + this.lugar + "\n  "
                + "Sede     : " + this.sede + "\n  "
                ;
	}

//	public Torneo(String idTorneo) {
//		this.idTorneo = idTorneo;
//	}
//
//	public Torneo(int idTorneo) {
//		this.idTorneo = String.valueOf(idTorneo);
//	}
//
	public static String getPareja(String jugador) throws Exception {
		String pagina = url + "?IdTorneo=10812";
		String selector = "tr.LineasRnk:contains(" + jugador + ") td:eq(2)";
		Document doc = Jsoup.connect(pagina).get();
		Elements cabs = doc.select(selector);
		return cabs.text();
	}

	public List<String> getParejas() throws Exception {
		List<String> parejas = new ArrayList<String>();
		String pagina = url + "?IdTorneo=" + idTorneo;
		String selector = "table:contains(ALEVIN FEMENINO) tr.LineasRnk td:eq(2)";
		Document doc = Jsoup.connect(pagina).get();
		Elements cabs = doc.select(selector);
		for (Element cab : cabs) {
			String pareja = cab.text();
			parejas.add(pareja);
		}
		return parejas;
		
	}
}
