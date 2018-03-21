<?php
// En el boton agregar se agrego un formulario para utilizar el boton "submit" que utiliza la variables 
// superglobales $_POST, $_GET por medio del cual se utiliza en este archivo para dar de alta un 
// status.
// Se valida que el usuario sea "Administrador" para que pueda realizar las funciones del CRUD.

//<!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
//continua con la ejecución del programa hacia abajo -->

if ($_POST['r'] == "status-add" && $_SESSION['role'] == "Admin" && !isset($_POST['crud']))
{
  // Mostrar el formulario.
  print('
    <h2 class = "p1">Agregar Status</h2>
    <!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
    continua con la ejecución del programa hacia abajo -->
     
    <form method="POST" class = "item">
      <div class = "p_25">
        <input type = "text" name="status" placeholder="status" required />
      </div>
      <div class = "p_25">
        <input class="button add" type="submit" value = "Agregar">
        <input type="hidden" name="r" value="status-add">
        <input type="hidden" name="crud" value="set">
      </div>
    </form>

    ');
}else if (($_POST['r'] == 'status-add') && ($_SESSION['role'] == "Admin") && ($_POST['crud'] == "set"))
{
  // Se programara la insercción de datos, es decir alta de Status.
  $status_controller = new StatusControler();
  // $_POST[status] = viene del formulario anterior, ya que se autoejecuta, no tiene la instruccion
  // "Action" del formulario.
  $new_status = array(
    'status_id' => 0, // Se coloca 0 para que se autoincremente, del último número le suma un 1.
    'status' => $_POST['status']
  );

  // Esta linea la graba a la base de datos.
  $status = $status_controller->set($new_status);
  $template = '
    <div class = "container">
      <p class="item add">Status <b>%s</b> salvado</p>
    </div>      
    <script>
      window.onload = function(){
          reloadPage("status") // Esta funcion se encuentra en el archivo "mexflix.js"
                                // se utiliza para recargar la página de "status" despues de 3 seg. 
          
        }

    </script>
  ';
  printf($template,$_POST['status']);
}
else // if ($_POST['r'] == 'status-add' && $_SESSION['role'] == "Admin")
{
  // Genera la vista de Usuario NO autorizado.
  $controller = new ViewController();
  $controller->load_view('error401');
  
}


?>