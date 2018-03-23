<?php
// En el boton agregar se agrego un formulario para utilizar el boton "submit" que utiliza la variables 
// superglobales $_POST, $_GET por medio del cual se utiliza en este archivo para dar de alta un 
// status.
// Se valida que el usuario sea "Administrador" para que pueda realizar las funciones del CRUD.

//<!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
//continua con la ejecución del programa hacia abajo -->

$users_controller = new UsersController();

if ($_POST['r'] == "user-edit" && $_SESSION['role'] == "Admin" && !isset($_POST['crud']))
{
  // "user", viene desde el formulario de "route" 
  $user = $users_controller->get($_POST['user']);
  if (empty($user))
  {
    $template = '
      <div class="container">
        <p class="item error">No existe el Usuario <b>%s</b></p>
      </div>  
      <script>
        window.onload = function(){
            reloadPage("usuarios") // Esta funcion se encuentra en el archivo "mexflix.js"
                                  // se utiliza para recargar la página de "usuarios" despues de 3 seg. 
          }
    </script>      
    ';
    printf($template,$_POST['user']);
  }
  else
  {
    // Para la etiqueta "Radio"
    $role_admin = ($user[0]['role'] == 'Admin') ? 'checked':'';
    $role_user = ($user[0]['role'] == 'User') ? 'checked':'';

    $template_user = ' 
      <h2 class = "p1">Editar Usuario</h2>
      <!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
      continua con la ejecución del programa hacia abajo -->
      
      <form method="POST" class = "item">
        <div class = "p_25">
          <!-- Cuando se tiene un valor deshabilitado, este no se pasa al Backedn (PHP)
          Por esta razón se utiliz el "hidden" -->
          <input type="text" placeholder="usuario" value="%s" disabled required>
          <input type="hidden" name="user" value="%s">
        </div>
        <div class = "p_25">
          <input type="email" name="email" placeholder="email" value="%s" required> 
        </div>
        <div class = "p_25">
          <input type="text" name="nombre" placeholder="nombre" value="%s" required>
        </div>
        <div class = "p_25">
          <input type="text" name="birthday" placeholder="Cumpleaños" value="%s" required>
        </div>
        <div class = "p_25">
        <!-- Se tendria que teclear un nuevo password o teclear el que se tenia.
          Si se mostrará la clave, esta 
        -->
          <input type="password" name="pass" placeholder="Password" value="" required>
        </div>
        <div class="p_25">
          <input type = "radio" name="role" id="admin" value="Admin" %s required>
          <label for="admin">Administrador</label>        
          <input type = "radio" name="role" id="noadmin" value="User" %s required>
          <label for="noadmin">Usuario</label>     
        </div>

        <div class = "p_25">
          <input class="button edit" type="submit" value = "Editar">
          <input type="hidden" name="r" value="user-edit">
          <input type="hidden" name="crud" value="set">
        </div>
      </form>    
    ';
    printf($template_user,
      $user[0]['user'],
      $user[0]['user'],
      $user[0]['email'],
      $user[0]['nombre'],
      $user[0]['birthday'],
      //$user[0]['pass'],
      $role_admin,
      $role_user
    );
  }

}else if (($_POST['r'] == 'user-edit') && ($_SESSION['role'] == "Admin") && ($_POST['crud'] == "set"))
{
  // Se programara la insercción de datos, es decir alta de Status.
  // $_POST[status] = viene del formulario anterior, ya que se autoejecuta, no tiene la instruccion
  // "Action" del formulario.
  $save_user = array(
    'user'=>$_POST['user'],
    'email'=>$_POST['email'],
    'nombre'=>$_POST['nombre'],    
    'birthday'=>$_POST['birthday'],
    'pass'=>$_POST['pass'],
    'role'=>$_POST['role']
  );

  // Esta linea la graba a la base de datos.
  $user = $users_controller->set($save_user);
  $template = '
    <div class = "container">
      <p class="item edit">Usuario <b>%s</b> salvado</p>
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
else // if ($_POST['r'] == 'user-add' && $_SESSION['role'] == "Admin")
{
  // Genera la vista de Usuario NO autorizado.
  $controller = new ViewController();
  $controller->load_view('error401');
  
}


?>