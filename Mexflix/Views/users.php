<?php
  // Para aplicar los estilos se utiliza la libreria "responsimple" de JonMircha

  print ('<h2 class = "p1">GESTION STATUS </h2>');

  $status_controller = new StatusControler();

  // Obtiene los datos de toda la tabla "Status". Devolviendo un arreglo asociativo.
  $status = $status_controller->get();
  // Determina si esta vacio el arreglo.
  if (empty($status))
  {
    print('
      <div class = "container"
        <p class = "item error">NO hay status De Películas</p>
      </div>
    ');
  }
  else
  {
    // Generando la tabla para mostrar la información de "Status".
    $templete_status = '
      <div class = "item">
        <table>
          <tr>
            <!-- Los encabezados de las tablas -->
            <th>ID</th>
            <th>Status</th>
            <!-- Se coloca un formulario para activar los botones, en este caso "Agregar" -->            
            <th colspan="2"> <!-- Para que ocupe 2 columnas la leyenda "Agregar" -->
              <form method="POST" >
                <!-- "r" = Ruta -->
                <input type = "hidden" name = "r" value = "status-add">
                <!-- Mandara llamar a un formulario para dar de alta nuevos "Status" -->
                <input class = "button add" type = "submit" value = "agregar">
              </form>
            </th>
          </tr>';
    // Se mostraran de forma dinámica los registros de la tabla "Status"
    // Se agrega el boton de editar y eliminar.

    for ($n=0;$n<count($status);$n++)
    {
      $templete_status .= '
        <tr>
          <!-- Es un arreglo Asociativo -->
          <td>'.$status[$n]["status_id"].'</td>
          <td>'.$status[$n]["status"].'</td>
          <td>
            <form method = "POST">
              <!-- "r" = Ruta -->
              <input type = "hidden" name = "r" value = "status-edit">
              <!-- Se enviará el "ID" de status -->
              <input type = "hidden" name = "status_id" value = "'.$status[$n]["status_id"].'">
              <!-- Mandara llamar a un formulario para editar un "Status" -->
              <input class = "button edit" type = "submit" value = "editar">
            </form>
          </td>
          <td>
            <form method = "POST">
              <!-- "r" = Ruta -->
              <input type = "hidden" name = "r" value = "status-delete">
              <!-- Se enviará el "ID" de status -->
              <input type = "hidden" name = "status_id" value = "'.$status[$n]["status_id"].'">
              <!-- Mandara llamar a un formulario para eliminar un "Status" -->
              <input class = "button delete" type = "submit" value = "Eliminar">
            </form>
          </td>
          
        </tr>
      ';
    }
    $templete_status .= '
        </table>
      </div>';

    print ($templete_status);
  }
?>


