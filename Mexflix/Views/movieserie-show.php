<?php
// Válida que en la ruta (URL) se haya oprimido el boton "Mostrar" (Se pasa por la URL)
// Además que exista el identificador de la MovieSerie

  if (($_POST['r']=='movieserie-show') AND (isset($_POST['imdb_id']))) 
  {    
    // Se muestra la información restante de la "MovieSerie"
    $ms_controller = new MovieSeriesController();
    $ms = $ms_controller->get($_POST['imdb_id']);
    // Determina si la consulta esta vacia.
    if (empty($ms))
    {
      printf('
        <div class= "container">
        <p class="item error">Error al cargar la información de MovieSerie <b>%s</b></p>
        </div>
      ',$_POST['imdb_id']);
    }
    else
    {
      // Se agregar la etiqueta "movieseries-info" para en futuro agregar algunos estilos.
      $template_ms = '
      <div class="item movieserie-info">
        <h2 class="p_5">%s</h2>
        <p class="p_5">%s</p>
        <p class="p_5">
          <small class="block">(%s)</small>
          <small class="block">%s</small>
          <small class="block">%s</small>
          <small class="block">%s</small>
          <small class="block">%s</small>
          <small class="block">%s</small>                                        
        </p>
        <!-- Indicando la ruta donde se encuentra la imagen del poster -->
        <img class="p_5 poster" src="./public/img/%s">
        <p class="p_5">Authors <b>%s</b></p>
        <p class="p_5">Actors <b>%s</b></p>        
        <articule class="p_5 ph7 mauto left">%s</articule>
        <div class="p_5 trailer">
          <!-- Para accesar al video en Youtube del trailer -->
          <iframe src = "%s" frameborder="0" allowfullscreen></iframe>          
        </div>
        <input class="p_5 button add" type="button" value="Regresar" onclick="history.back()">

      </div>
      ';
    }

    /* Para que se pueda reproducir desde "iframe" desde el programa, se tiene que 
     sustituir lo siguiente
     Esta es la pagina que esta grabada en la base de datos : 
     https://www.youtube.com/watch?v=4ttHN-hC3_s

     La linea que se ocupa para reproducirlo en el programa "iframe" es : "embed"
     Por lo que se tiene que sustituir "wath?v="
     https://www.youtube.com/embed/k_UTfaGCDnU
     
    */

    $trailer = str_replace('watch?v=','embed/',$ms[0]['trailer']);
    printf(
      $template_ms,
      $ms[0]['title'],
      $ms[0]['genres'],
      $ms[0]['imdb_id'],
      $ms[0]['status'],
      $ms[0]['category'],
      $ms[0]['country'],
      $ms[0]['premiere'],
      $ms[0]['rating'],
      $ms[0]['poster'],
      $ms[0]['author'],
      $ms[0]['actors'],
      $ms[0]['plot'],
      $trailer
    );
  }
  else
  {
    // Mensaje de error de recurso no Encontrado.
    $controller = new ViewController();
    $controller->load_view('error404');
    print(var_dump($_POST['r']));

  }
?>
