/* Listado de operaciones CRUD de mexflix */

/* movieseries */
-- Crear movieseries
  INSERT INTO movieseries 
    SET imdb_id = 'tt3749900',
        title = 'Gotam',
        plot = '',
        author = '',
        actors = '',
        country = '',
        premiere = '2014',
        trailer = '',
        poster = '',
        rating = 8.0,
        genres = 'Crime, Drame, Thriller',
        category = 'Serie',
        status = 7;

-- Actualizar movieseries
  UPDATE movieseries SET title = 'Gotham',
    plot = 'Descripcion de la pelicula\s',
    genres = 'Crime, Drame, Thriller',
    author = 'Bruno Heller',
    actors = 'Todos los actores de la pelicula',
    country = 'EUA',
    premiere = '2014',
    trailer = 'Promoción pelicula',
    poster = 'Posters de la Pelicula',
    rating = 8.0,
    category = 'Series',
    status = 7
  WHERE imdb_id = 'tt3749900';

-- Eliminar movieseries
DELETE FROM movieseries WHERE imdb_id = 'tt3749900';

-- Buscar Todas las movieseries
 SELECT ms.imdb_id,ms.title,ms.plot,ms.author,ms.actors,ms.country,ms.premiere,ms.trailer,
  ms.poster,ms.rating,ms.genres,ms.category,s.status 
  FROM movieseries AS ms 
  INNER JOIN status AS s
  ON ms.status = s.status_id;

-- Buscar una movieseries por título, personas, actores,genero
  SELECT ms.imdb_id,ms.title,ms.plot,ms.author,ms.actors,ms.country,ms.premiere,ms.trailer,
  ms.poster,ms.rating,ms.genres,ms.category,s.status 
  FROM movieseries AS ms 
  INNER JOIN status AS s
  ON ms.status = s.status_id
  WHERE MATCH (ms.title,ms.author,ms.actors,ms.genres)
  AGAINST('Drama'IN BOOLEAN MODE);

-- Buscar una movieserie por categoria.
  SELECT ms.imdb_id,ms.title,ms.plot,ms.author,ms.actors,ms.country,ms.premiere,ms.trailer,
    ms.poster,ms.rating,ms.genres,ms.category,s.status 
  FROM movieseries AS ms 
  INNER JOIN status AS s
  ON ms.status = s.status_id
  WHERE ms.category = 'Serie';

-- Buscar una movieserie por status.
  SELECT ms.imdb_id,ms.title,ms.plot,ms.author,ms.actors,ms.country,ms.premiere,ms.trailer,
      ms.poster,ms.rating,ms.genres,ms.category,s.status 
    FROM movieseries AS ms 
    INNER JOIN status AS s
    ON ms.status = s.status_id
    WHERE ms.status = 7;

-- status
--   Crear status
  INSERT INTO status SET status_id = 0, status = 'Otro estado';

  REPLACE status SET status_id = 0, status = “Otro estado”
  REPLACE INTO status (status_id,status) VALUES (0,”Otro estado”)

--   Actualizar status
  UPDATE status SET status = 'Other status' WHERE status_id = 6;
  
  REPLACE users SET status_id = 6, status = 'Other status';
/* Se tiene que agregar los demas campos,
si los maneja, de lo contrario les asigna NULL*/ 


--   Eliminar status
  DELETE FROM status WHERE status_id = 6;

--   Buscar todos los status
  SELECT * FROM status;

-- Buscar un status por su status_id
  SELECT * FROM status WHERE status_id = 3;
  
-- users
--   Crear usuarios.
  INSERT INTO users SET 
    user = '@usuario', 
    email = 'usuario@midominio.com',
    name = 'Soy un usuario',
    birthday = '1988-10-09',
    pass = MD5('un_password'),
    rol = 'Admin';

--   Actualizar usuario
--     Datos generales.
  UPDATE users SET name = 'Soy un Usuario',
    birthday = '1984-10-09',
    role = 'User',
    WHERE user = '@usuario' AND email = 'usuario@midominio.com';

--     Password
  UPDATE users SET pass = MD5('un_nuevo_password')
    WHERE user = '@usuario' AND email = 'usuario@midominio.com';

REPLACE users SET user = '@usuario', pass = MD5('un nuevo password');
/* Se tiene que agregar los demas campos, de lo contrario les asigna NULL*/ 


REPLACE INTO status (status_id,status) VALUES (4,”Otro estado”);
Ahora realiza una actualización 



REPLACE users SET user = ‘@usuario’, pass = MD5(‘un nuevo password’);

--   Eliminar
  DELETE FROM users WHERE user = '@usuario' AND email = 'usuario@midominio.com';

--   Buscar todos los usuarios
  SELECT * FROM users;

--   Buscar un usuario en particular por:
--     usuario
  SELECT * FROM users WHERE user = '@usuario'

--     correo electronico
  SELECT * FROM users WHERE email = 'usuario@midominio.com';

--   Buscar por Rol
  SELECT * FROM users WHERE rol = 'User';
