<?php
  // Para aplicar los estilos se utiliza la libreria "responsimple" de JonMircha

  print ('<h2 class = "p1">GESTION USUARIOS </h2>');

  $users_controller = new UsersController();

  // Obtiene los datos de toda la tabla "Users". Devolviendo un arreglo asociativo.
  $users = $users_controller->get();
  // Determina si esta vacio el arreglo.
  if (empty($users))
  {
    print('
      <div class = "container"
        <p class = "item error">NO hay Usuarios</p>
      </div>
    ');
  }
  else
  {
    // Generando la tabla para mostrar la información de "Usuarios".
    $templete_users = '
      <div class = "item">
        <table>
          <tr>
            <!-- Los encabezados de las tablas -->
            <th>Usuario</th>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Cumpleanos</th>
            <th>Contraseña</th>
            <th>Roll</th>
            
            <!-- Se coloca un formulario para activar los botones, en este caso "Agregar" -->            
            <th colspan="2"> <!-- Para que ocupe 2 columnas la leyenda "Agregar" -->
              <form method="POST" >
                <!-- "r" = Ruta -->
                <input type = "hidden" name = "r" value = "user-add">
                <!-- Mandara llamar a un formulario para dar de alta nuevos "Status" -->
                <input class = "button add" type = "submit" value = "Agregar">
              </form>
            </th>
          </tr>';
    // Se mostraran de forma dinámica los registros de la tabla "Usuarios"
    // Se agrega el boton de editar y eliminar.

    for ($n=0;$n<count($users);$n++)
    {
      $templete_users .= '
        <tr>
          <!-- Es un arreglo Asociativo -->
          <td>'.$users[$n]["user"].'</td>
          <td>'.$users[$n]["email"].'</td>
          <td>'.$users[$n]["nombre"].'</td>
          <td>'.$users[$n]["birthday"].'</td>
          <td>'.$users[$n]["pass"].'</td>
          <td>'.$users[$n]["role"].'</td>
          
          <td>
            <form method = "POST">
              <!-- "r" = Ruta -->
              <input type = "hidden" name = "r" value = "user-edit">
              <!-- Se enviará el "ID" del usuario -->
              <input type = "hidden" name = "user" value = "'.$users[$n]["user"].'">
              <!-- Mandara llamar a un formulario para editar un "Usuario" -->
              <input class = "button edit" type = "submit" value = "editar">
            </form>
          </td>
          <td>
            <form method = "POST">
              <!-- "r" = Ruta -->
              <input type = "hidden" name = "r" value = "user-delete">
              <!-- Se enviará el "ID" del usuario -->
              <input type = "hidden" name = "user" value = "'.$users[$n]["user"].'">
              <!-- Mandara llamar a un formulario para eliminar un "Usuario" -->
              <input class = "button delete" type = "submit" value = "Eliminar">
            </form>
          </td>
          
        </tr>
      ';
    }
    $templete_users .= '
        </table>
      </div>';

    print ($templete_users);
  }
?>


