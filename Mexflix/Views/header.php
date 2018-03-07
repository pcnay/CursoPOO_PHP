<!DOCTYPE html>
<html lang= "es">
  <head>
    <!-- Definiendo los valores para que se pueda ver en celular -->
    <meta name = "viewport" content= "width=device-width", initial-scale=1>
    <meta charset="UTF-8">
    <title>Mexflix</title>
    <meta name="description" content = "Bienvenidos a MexFlix tus peliculas y series favorita">
    <!-- Para colocar el icono en la pestaña del navegador -->
    <link rel = "shorcut icon " type= "image/png" href = "./public/img/favicon.png">

    <!-- Libreria realizada por Mircha "responsimple" : http://jonmircha.github.io/responsimple/ -->    
    <link rel = "stylesheet" href="./public/css/responsimple.min.css">
    
    <link rel = "stylesheet" href="./public/css/mexflix.css">


  </head>
  <body>
    <!-- Se utiliza el css "responsimple" -->
    <header class = "container  center  header" >
    <!-- Definiendo el logo para celular y pantalla normales centrado-->
    <!-- lg-left = Cuando sean en pantalla el logo se aline a la izq. recuadro que correspoda-->
      <div class="item  i-b  v-middle  ph12  lg2 lg-left">
        <h1 class="logo">Mexflix</h1>
      </div>
      <!-- Menú de navegación -->
      <!-- lg-rigth = Cuando sean en pantalla el menu se aline a la derecha. recuadro que correspoda-->
      <nav class = "item  i-b  v-middle  ph12  lg10  menu lg-right">
        <ul class = "container">
          <li class = "nobullet  item  inline "><a href = "./">Inicio</a></li>
          <li class = "nobullet  item  inline "><a href = "movieseries">Movieserie</a></li>
          <li class = "nobullet  item  inline "><a href = "usuarios">Usuarios</a></li>
          <li class = "nobullet  item  inline "><a href = "status">Status</a></li>
          <li class = "nobullet  item  inline "><a href = "salir">Salir</a></li>
        </ul>

      </nav>
    </hearder>
    <main class ="container  center  main">