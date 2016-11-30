DROP DATABASE IF EXISTS padel;
CREATE DATABASE padel;
USE padel;

DROP TABLE IF EXISTS Torneos;
DROP TABLE IF EXISTS Categorias;
DROP TABLE IF EXISTS Rondas;
DROP TABLE IF EXISTS Jugadores;
DROP TABLE IF EXISTS Inscripciones;
DROP TABLE IF EXISTS Parejas;
DROP TABLE IF EXISTS Cuadros;

CREATE TABLE Torneos (
  id INT NOT NULL,
  fecha_inicio DATE,
  fecha_fin DATE,
  torneo VARCHAR(150) NOT NULL,
  categoria VARCHAR(50) NOT NULL DEFAULT 'MENORES',
  tipo VARCHAR(50) NOT NULL DEFAULT 'A',
  lugar VARCHAR(150) DEFAULT NULL,
  sede VARCHAR(150) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Categorias (
  id INT NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  genero VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Rondas (
  id INT NOT NULL,
  cuadro VARCHAR(50) NOT NULL,
  ronda VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Jugadores (
  id INT NOT NULL,
  nombre VARCHAR(150) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Parejas (
  id INT NOT NULL,
  id_jugador_1 INT NOT NULL,
  id_jugador_2 INT NOT NULL,
--  FOREIGN KEY (id_jugador_1) REFERENCES Jugadores(id),
--  FOREIGN KEY (id_jugador_2) REFERENCES Jugadores(id),
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Inscripciones (
  id INT NOT NULL AUTO_INCREMENT,
  id_torneo INT NOT NULL,
  id_pareja INT NOT NULL, 
  id_categoria INT NOT NULL,
--  FOREIGN KEY (id_torneo) REFERENCES Torneos(id),
--  FOREIGN KEY (id_pareja) REFERENCES Parejas(id),
--  FOREIGN KEY (id_categoria) REFERENCES Categorias(id),
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Cuadros (
  id INT NOT NULL AUTO_INCREMENT,
  id_torneo INT NOT NULL,
  id_ronda INT NOT NULL,
  id_categoria INT NOT NULL,
  id_pareja_1 INT DEFAULT NULL,
  id_pareja_2 INT DEFAULT NULL,
  id_pareja_ganadora INT DEFAULT NULL,
  resultado VARCHAR(50) DEFAULT NULL,
--  FOREIGN KEY (id_torneo) REFERENCES Torneos(id),
--  FOREIGN KEY (id_ronda) REFERENCES Rondas(id),
--  FOREIGN KEY (id_categoria) REFERENCES Categorias(id),
--  FOREIGN KEY (id_pareja_1) REFERENCES Parejas(id),
--  FOREIGN KEY (id_pareja_2) REFERENCES Parejas(id),
--  FOREIGN KEY (id_pareja_ganadora) REFERENCES Parejas(id),
  PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO Categorias (id, categoria, genero) VALUES (114,'Benjamin','Masculino');
INSERT INTO Categorias (id, categoria, genero) VALUES (115,'Benjamin','Femenino');
INSERT INTO Categorias (id, categoria, genero) VALUES (116,'Alevin','Femenino');
INSERT INTO Categorias (id, categoria, genero) VALUES (117,'Alevin','Masculino');
INSERT INTO Categorias (id, categoria, genero) VALUES (118,'Infantil','Femenino');
INSERT INTO Categorias (id, categoria, genero) VALUES (119,'Infantil','Masculino');
INSERT INTO Categorias (id, categoria, genero) VALUES (120,'Cadete','Femenino');
INSERT INTO Categorias (id, categoria, genero) VALUES (121,'Cadete','Masculino');
INSERT INTO Categorias (id, categoria, genero) VALUES (122,'Junior','Femenino');
INSERT INTO Categorias (id, categoria, genero) VALUES (123,'Junior','Masculino');

INSERT INTO Rondas (id, cuadro, ronda) VALUES (101,'Principal','Final');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (102,'Principal','Semifinales');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (104,'Principal','Cuartos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (108,'Principal','Octavos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (116,'Principal','Dieciseisavos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (132,'Principal','Treintaidosavos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (201,'Consolacion','Final');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (202,'Consolacion','Semifinales');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (204,'Consolacion','Cuartos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (208,'Consolacion','Octavos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (216,'Consolacion','Dieciseisavos');
INSERT INTO Rondas (id, cuadro, ronda) VALUES (232,'Consolacion','Treintaidosavos');