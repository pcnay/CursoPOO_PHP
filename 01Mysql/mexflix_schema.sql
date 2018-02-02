/* 
  MexFlix base de datos de películas y series.
  VARCHAR = Es una cadena variable no se desperdicia para la B.D. y memoria
  Si se define de 20, pero si se escribe solo 10 es lo que se utiliza.
  HTTP://WWW.MYSQL.CONCLASE.NET, Sección Tipos de columnas describen las que maneja MySQL.
  Los tipos de datos TEXT no puede aplicar "Default".
  Tablas Catalogo, biene precargada.
  Tabla de Datos es donde se guardara la información.
  ENUM que solo tenga 5 o hasta 10 , además que no se agregan.

*/

/* Esta instruccion solo de ejecuta para pruebas, una vez establecida la estructura 
permanente eliminarla 
*/
DROP DATABASE IF EXISTS mexflix;

CREATE DATABASE IF NOT EXISTS mexflix;
USE mexflix;

/* Tabla Catálogo , se coloca al principio para poder relacionarla con la de "movieseries" */
/* ENUM('Coming Soon','Release','In Issue','Finished','Canceled') NOT NULL*/
CREATE TABLE status
(
  status_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  status VARCHAR(20) NOT NULL
);

/* Tabla de Datos */
CREATE TABLE movieseries(
  imdb_id CHAR(9) PRIMARY KEY,
  title VARCHAR(80) NOT NULL,
  plot TEXT,
  author VARCHAR(100) DEFAULT 'Pending',
  actors VARCHAR(100) DEFAULT 'Pending',
  country VARCHAR(30) DEFAULT 'Unknown',
  premiere YEAR(4) NOT NULL,
  poster VARCHAR(150) DEFAULT 'no-poster.jpg',
  trailer VARCHAR(150) DEFAULT 'no-trailer.jpg',
  rating DECIMAL(2,1),
  genres VARCHAR(50) NOT NULL,
  status INTEGER UNSIGNED NOT NULL,
  category ENUM('Movie','Serie') NOT NULL,
  /*Para Busquedas en mas de dos campos, no se muestra en la estructura de la tabla
  es de tipo dinámico, solo se muestra cuando se requiera. */
  FULLTEXT KEY search(title,author,actors,genres), 

  /*
  RESTRICT = Si se quiere eliminar en la tabla de "status" por ejemplo un valor "release"
  pero existe en la tabla de Movieseries, no lo va a dejar, hasta que se elimine "release"
  en la tabla "Movieserie".
  CASCADE = Si se cambiara el nombre de "release" a "liberado" en la tabla de "status"
  en automatico se actualiza en la tabla de "Movieserie"
   Mas documentacion : blog.openalfa.com -> como trabajan las restricciones en MySQL


   Crando la relacion con la tabla "Status"
   */
  FOREIGN KEY (status) REFERENCES status(status_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);


/* UNIQUE = Es único, que no se repita. 
"pass" se manejara encriptado con el método MD5 y este maneja 32 posiciones.
*/

CREATE TABLE users
(
  user VARCHAR(15) PRIMARY KEY,
  email VARCHAR(80) UNIQUE NOT NULL, 
  nombre VARCHAR(100) NOT NULL,
  birthday DATE NOT NULL,
  pass CHAR(32) NOT NULL,
  role ENUM ('Admin','User') NOT NULL
);
