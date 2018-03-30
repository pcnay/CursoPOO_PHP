<?php
  // Para aplicar los estilos se utiliza la libreria "responsimple" de JonMircha

  print ('<h2 class = "p1">GESTION PELICULAS </h2>');

  $ms_controller = new MovieSeriesController();

  // Obtiene los datos de toda la tabla "MovieSerie". Devolviendo un arreglo asociativo.
  $ms = $ms_controller->get();
  // Determina si esta vacio el arreglo.
  if (empty($ms))
  {
    print('
      <div class = "container">
        <p class = "item error">NO hay MovieSeries</p>
      </div>
    ');
  }
  else
  {
    // Generando la tabla para mostrar la información de "MovieSeries".
    $template_ms = '
      <div class = "item">
        <table>
          <tr>
            <!-- Los encabezados de las tablas -->
            <th>IMDB Id</th>
            <th>Título</th>
            <th>Estreno</th>
            <th>Géneros</th>
            <th>Status</th>
            <th>Categoría</th>
            
            <!-- Se coloca un formulario para activar los botones, en este caso "Agregar" -->            
            <th colspan="3"> <!-- Para que ocupe 3 columnas la leyenda "Agregar" -->
              <form method="POST" >
                <!-- "r" = Ruta -->
                <input type = "hidden" name = "r" value = "movieserie-add">
                <!-- Mandara llamar a un formulario para dar de alta nuevo "MovieSerie" -->
                <input class = "button add" type = "submit" value = "Agregar">
              </form>
            </th>
          </tr>';
    // Se mostraran de forma dinámica los registros de la tabla "MovieSerie"
    // Se agrega el boton de editar y eliminar.

    for ($n=0;$n<count($ms);$n++)
    {
      $template_ms .= '
        <tr>
          <!-- Es un arreglo Asociativo -->
          <td>'.$ms[$n]["imdb_id"].'</td>
          <td>'.$ms[$n]["title"].'</td>
          <td>'.$ms[$n]["premiere"].'</td>
          <td>'.$ms[$n]["genres"].'</td>
          <td>'.$ms[$n]["status"].'</td>
          <td>'.$ms[$n]["category"].'</td>
          
          <td>
            <form method = "POST">
              <!-- "r" = Ruta -->
              <input type="hidden" name="r" value="movieserie-show">
              <!-- Se enviará el "ID" de MovieSerie -->
              <input type="hidden" name="imdb_id" value="'.$ms[$n]["imdb_id"].'">
              <!-- Mandara llamar a un formulario para editar una "MovieSerie" -->
              <input class="button show" type="submit" value="Mostrar">
            </form> 
          </td>
          <td>
            <form method = "POST">
            
              <!-- "r" = Ruta -->
              <input type = "hidden" name = "r" value = "movieserie-edit">
              <!-- Se enviará el "ID" de MovieSerie -->
              <input type = "hidden" name = "imdb_id" value = "'.$ms[$n]["imdb_id"].'">
              <!-- Mandara llamar a un formulario para editar una "MovieSerie" -->
              <input class = "button edit" type = "submit" value = "editar">
            </form>
          </td>
          <td>
            <form method = "POST">
              <!-- "r" = Ruta -->
              <input type = "hidden" name = "r" value = "movieserie-delete">
              <!-- Se enviará el "ID" de MovieSerie -->
              <input type = "hidden" name = "imdb_id" value = "'.$ms[$n]["imdb_id"].'">
              <!-- Mandara llamar a un formulario para eliminar una "MovieSerie" -->
              <input class = "button delete" type = "submit" value = "Eliminar">
            </form>
          </td>
          
        </tr>
      ';
    }
    $template_ms .= '
        </table>
      </div>';

    print ($template_ms);
  }
?>


