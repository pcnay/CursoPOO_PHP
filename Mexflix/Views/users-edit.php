<?php
// En el boton agregar se agrego un formulario para utilizar el boton "submit" que utiliza la variables 
// superglobales $_POST, $_GET por medio del cual se utiliza en este archivo para dar de alta un 
// status.
// Se valida que el usuario sea "Administrador" para que pueda realizar las funciones del CRUD.

//<!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
//continua con la ejecución del programa hacia abajo -->

$status_controller = new StatusControler();

if ($_POST['r'] == "status-edit" && $_SESSION['role'] == "Admin" && !isset($_POST['crud']))
{
  // "status_id", viene desde el formulario de "route" 
  $status = $status_controller->get($_POST['status_id']);
  if (empty($status))
  {
    $template = '
      <div class="container">
        <p class="item error">No existe el status_id <b>%s</b></p>
      </div>  
      <script>
        window.onload = function(){
            reloadPage("status") // Esta funcion se encuentra en el archivo "mexflix.js"
                                  // se utiliza para recargar la página de "status" despues de 3 seg. 
          }
    </script>      
    ';
  }
  else
  {
    $template_status = ' 
      <h2 class = "p1">Editar Status</h2>
      <!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
      continua con la ejecución del programa hacia abajo -->
      
      <form method="POST" class = "item">
        <div class = "p_25">
          <!-- Cuando se tiene un valor deshabilitado, este no se pasa al Backedn (PHP)
          Por esta razón se utiliz el "hidden" -->
          <input type = "text" placeholder="status_id" value = "%s" disabled required>
          <input type = "hidden" name="status_id" value = "%s" >
        </div>
        <div class = "p_25">
          <input type = "text" name="status" placeholder="status" value = "%s" required>
        </div>
        
        <div class = "p_25">
          <input class="button edit" type="submit" value = "Editar">
          <input type="hidden" name="r" value="status-edit">
          <input type="hidden" name="crud" value="set">
        </div>
      </form>    
    ';
    printf($template_status,
      $status[0]['status_id'],
      $status[0]['status_id'],
      $status[0]['status']
    );
  }

}else if (($_POST['r'] == 'status-edit') && ($_SESSION['role'] == "Admin") && ($_POST['crud'] == "set"))
{
  // Se programara la insercción de datos, es decir alta de Status.
  // $_POST[status] = viene del formulario anterior, ya que se autoejecuta, no tiene la instruccion
  // "Action" del formulario.
  $save_status = array(
    'status_id' => $_POST['status_id'],
    'status' => $_POST['status']
  );

  // Esta linea la graba a la base de datos.
  $status = $status_controller->set($save_status);
  $template = '
    <div class = "container">
      <p class="item edit">Status <b>%s</b> salvado</p>
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