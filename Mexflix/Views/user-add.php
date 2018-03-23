<?php
// En el boton agregar se agrego un formulario para utilizar el boton "submit" que utiliza la variables 
// superglobales $_POST, $_GET por medio del cual se utiliza en este archivo para dar de alta un 
// status.
// Se valida que el usuario sea "Administrador" para que pueda realizar las funciones del CRUD.

//<!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
//continua con la ejecución del programa hacia abajo -->

if ($_POST['r'] == "user-add" && $_SESSION['role'] == "Admin" && !isset($_POST['crud']))
{
  // Mostrar el formulario.
  print('
    <h2 class = "p1">Agregar Usuario</h2>
    <!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
    continua con la ejecución del programa hacia abajo -->
     
    <form method="POST" class = "item">
      <div class="p_25">
        <input type = "text" name="user" placeholder="usuario" required>        
      </div>
      <div class="p_25">
        <input type = "email" name="email" placeholder="email" required>        
      </div>
      <div class="p_25">
        <input type = "text" name="nombre" placeholder="nombre" required>        
      </div>
      <div class="p_25">
        <input type = "text" name="birthday" placeholder="cumpleaños" required>        
      </div>
      <div class="p_25">
        <input type = "password" name="pass" placeholder="password" required>        
      </div>
      <div class="p_25">
        <input type = "radio" name="role" id="admin" value="Admin" required>
        <label for="admin">Administrador</label>        
        <input type = "radio" name="role" id="noadmin" value="User" required>
        <label for="noadmin">Usuario</label>     
      </div>


      <div class = "p_25">
        <input class="button add" type="submit" value = "Agregar">
        <input type="hidden" name="r" value="user-add">
        <input type="hidden" name="crud" value="set">
      </div>
    </form>

    ');
}else if (($_POST['r'] == 'user-add') && ($_SESSION['role'] == "Admin") && ($_POST['crud'] == "set"))
{
  // Se programara la insercción de datos, es decir alta de Usuarios.
  $users_controller = new UsersController();
  // $_POST[status] = viene del formulario anterior, ya que se autoejecuta, no tiene la instruccion
  // "Action" del formulario.
  $new_user = array(
    'user'=>$_POST['user'],
    'email'=>$_POST['email'],
    'nombre'=>$_POST['nombre'],    
    'birthday'=>$_POST['birthday'],
    'pass'=>$_POST['pass'],
    'role'=>$_POST['role']
  );

  // Esta linea la graba a la base de datos.
  $user = $users_controller->set($new_user);
  $template = '
    <div class = "container">
      <p class="item add">Usuario <b>%s</b> salvado</p>
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