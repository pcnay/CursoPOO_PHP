INSERT INTO movieseries 
  SET imdb_id = 'tt3749990',
      title = 'Gotham',
      genres = 'Crime, Drama Thriller',
      premiere = '2014',
      status = 3;


UPDATE movieseries SET author = 'Bruno Heller', actors = 'Actores ', country = 'EUA', poster = 'posters ', trailer = 'Video promocional',
  rating = 8.5, category = 'Serie ', plot = 'Sipnosis de la pelicula ' WHERE imdb_id = 'tt3749990';
  
DELETE FROM movieseries WHERE imdb_id = 'tt3749990';

SELECT * FROM movieseries;

/* Obteniendo el número de registros */ 
SELECT COUNT(*) FROM movieseries;

SELECT * FROM movieseries WHERE category = 'Serie';

SELECT title,category,country,genres,premiere,status FROM movieseries WHERE category = 'Serie' ORDER BY premiere;

/* 
LIKE '%EUA' Independientemente como inicie el valor del campo 
LIKE 'EUA%' Independientemente como termine el valor del campo 
*/

SELECT title,category,country,genres,premiere,status FROM movieseries WHERE category = 'Serie' AND country LIKE '%EUA' ORDER BY premiere;

SELECT title,category,country,genres,premiere,status FROM movieseries WHERE category = 'Serie' AND genres LIKE '%Drama%' ORDER BY premiere;

SELECT title,category,country,genres,premiere,status FROM movieseries WHERE status = 1 OR status = 3 ORDER BY premiere;

/* Consultas multiples

Obtener datos de mas de una tabla.

SELECT * FROM table1 AS t1
  INNER JOIN table2 AS t2 
  {  
  Une la t1 a la t2, seleccionado todos los registros de las dos tablas. No se especifica 
  una condicional.
  Se crea una multiplicacion de arreglos.
  }

/* Por cada  registros de "movieseries" lo repite para cada registros de "status" */
SELECT * FROM movieseries AS ms INNER JOIN status AS s;

/*
SELECT * FROM table1 AS t1  
  INNER JOIN table2 AS t2 ON t1.a_field = t2.a_field

{
    Selecciona todos los campos de la tabla 1 y los campos de la tabla 2, cuando (ON)
    un campo de la tabla1 coincida con la tabla 2.
    "ON" es la condicional .
    Se evalua por el el campo que se relacionan estas tablas.
}
*/
SELECT * FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id;

/*
SELECT t1.field1,t1.field2,t1.field3,t2.field1,t2.field2
FROM table1 AS t1
INNER JOIN table2 AS t2
WHERE t1.field1 = 'a_value'
ORDER BY t1.field3 DESC

{
  Seleccionando solo algunos campos y aplicando condiciones en las uniones de las tablas
  ordenar las columnas.
}
*/

SELECT ms.title,ms.category,ms.country,ms.genres,ms.premiere,s.status 
FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id
WHERE (s.status = 'In Issue' OR s.status = 'Cooming Soon') AND ms.category = 'Serie'
ORDER BY ms.premiere DESC;
/*
Despliega el nombre del "status" en lugar del id. "In Issue".
Utiliza condicionales OR y AND pertenecientes a las dos tablas.
Tener en cuenta las condicionales OR o AND se debe manejar con parentesis para separarlos
Ejecucion : Gotham Serie EUA Crime, Drama Thriller 2014 "In Issue"

*/

/*
  Consulta de tipo FULLTEXT KEY  
*/
SELECT * FROM movieseries
  WHERE MATCH (title,author,actors,genres)
  AGAINST('crime' IN BOOLEAN MODE);

/* Consulta multiples con la opción FULL TEXT */
SELECT ms.title,ms.category,ms.country,ms.genres,ms.premiere,s.status,ms.author,ms.actors
  FROM movieseries AS ms 
  INNER JOIN  status AS s 
  ON ms.status = s.status_id
  WHERE MATCH (ms.title,ms.author,ms.actors,ms.genres)
  AGAINST ('drama' IN BOOLEAN MODE)
  ORDER BY ms.premiere;

/* Integridad Referencial */


/*
Con la validacion de cuando se Borrar se restringa:

  MySQL pemrite eliminar los registros de la tabla "movieseries" del status = 1 Coming Soon 
 */ 
INSERT INTO status SET status = 'Otro Status', status_id = 0;

/*
  MySQL pemrite eliminar los registros de la tabla "movieseries" del status = 1 Coming Soon 

*/ 
DELETE FROM movieseries WHERE status = 1;

/*
 Permite eliminar el reg. con el status = 1 porque ya no hay registros asociados en la tabla
 dependiente (movieseries)
*/

DELETE FROM status WHERE status_id = 2;
/*
  En esta ocasión no permitio borrar el reg. del status = 2, ya que en la tabla dependiente 
  tiene registros, es donde se aplica la Integridad referencial.
  Va a permitir borrarlo hasta que no existan registros con status = 2; en la tabla de "movieseries"
*/

/*
  Con la validacion de cuando se Actualize lo realize en Cascada :  
*/
SELECT ms.title,ms.status,s.status_id,s.status 
  FROM movieseries AS ms 
  INNER JOIN status AS s 
  ON ms.status = s.status_id
  ORDER BY s.status,ms.title ASC;

UPDATE status SET status_id = 7,status = 'Estrenada'
  WHERE status_id = 3; 