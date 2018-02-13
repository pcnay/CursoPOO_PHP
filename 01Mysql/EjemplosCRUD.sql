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

/* Consultas multiples */
