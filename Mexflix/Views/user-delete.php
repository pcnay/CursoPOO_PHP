<?php
// En el boton agregar se agrego un formulario para utilizar el boton "submit" que utiliza la variables 
// superglobales $_POST, $_GET por medio del cual se utiliza en este archivo para dar de alta un 
// status.
// Se valida que el usuario sea "Administrador" para que pueda realizar las funciones del CRUD.

//<!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
//continua con la ejecución del programa hacia abajo -->

$users_controller = new UsersController();

if ($_POST['r'] == "user-delete" && $_SESSION['role'] == "Admin" && !isset($_POST['crud']))
{
  // "user", viene desde el formulario de "route" 
  $user = $users_controller->get($_POST['user']);
  if (empty($user))
  {
    $template = '
      <div class="container">
        <p class="item error">No existe el usuario <b>%s</b></p>
      </div>  
      <script>
        window.onload = function(){
            reloadPage("usuarios") // Esta funcion se encuentra en el archivo "mexflix.js"
                                  // se utiliza para recargar la página de "status" despues de 3 seg. 
          }
    </script>      
    ';
  }
  else
  {
    $template_user = '
      <h2 class="p1">Eliminar Usuario</h2>
      <form method = "POST" class="item">
        <div class = "p1 f2">
          Estas seguro de eliminar el Usuario : <mark class="p1">%s</mark> ?
        </div>
        <div class = "p_25">
          <input class="button delete" type="submit" value="SI">
          <input class="button add" type="button" value="NO" onclick="history.back()">
          <input type="hidden" name = "user" value="%s">          
          <input type="hidden" name = "r" value="user-delete">
          <input type="hidden" name = "crud" value="del">

        </div>

      </form>
    ';

    printf($template_user,
      $user[0]['user'],
      $user[0]['user']      
    );
  }

}else if (($_POST['r'] == 'user-delete') && ($_SESSION['role'] == "Admin") && ($_POST['crud'] == "del"))
  {
  // Se programara el borrado de "Status"
  // $_POST[status] = viene del formulario anterior, ya que se autoejecuta, no tiene la instruccion
  // "Action" del formulario.
  
  // Esta linea borra el "usuario" de la base de datos.
  $user = $users_controller->del($_POST['user']);
  $template = '
    <div class = "container">
      <p class="item delete">Usuario <b>%s</b> eliminado</p>
    </div>      
    <script>
      window.onload = function(){
          reloadPage("usuarios") // Esta funcion se encuentra en el archivo "mexflix.js"
                                // se utiliza para recargar la página de "status" despues de 3 seg. 
          
        }

    </script>
  ';
  printf($template,$_POST['user']);
}
else // if ($_POST['r'] == 'user-delete' && $_SESSION['role'] == "Admin")
{
  // Genera la vista de Usuario NO autorizado.
  $controller = new ViewController();
  $controller->load_view('error401');
  
}


?>