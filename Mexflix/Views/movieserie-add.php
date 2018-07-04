<?php
// En el boton agregar se agrego un formulario para utilizar el boton "submit" que utiliza la variables 
// superglobales $_POST, $_GET por medio del cual se utiliza en este archivo para dar de alta un 
// status.
// Se valida que el usuario sea "Administrador" para que pueda realizar las funciones del CRUD.

//<!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
//continua con la ejecución del programa hacia abajo -->

if ($_POST['r'] == "movieserie-add" && $_SESSION['role'] == "Admin" && !isset($_POST['crud']))
{
  // Mostrar el formulario.
  $status_controller = new StatusControler();
  // Se obtienen los valores de la tabla "Status", si no se pasa parámetros obtiene todos 

  $status = $status_controller->get();

  // Formara los "option" de la etiqueta "SELECT" abajo definida
  $status_select = '';
  for ($n=0;$n<count($status);$n++)  
  {
    $status_select .= '<option value="'.$status[$n]['status_id'].'">'.$status[$n]['status'].'</option>';
  }

  printf('
    <h2 class = "p1">Agregar MovieSerie</h2>
    <!-- Como en el formulario no se indica un "Action" la página se autoprocesa, es decire
    continua con la ejecución del programa hacia abajo -->
     
    <form method="POST" class = "item">
      <div class="p_25">
        <input type="text" name="imdb_id" placeholder="imdb_id" required></input>
      </div>
      <div class="p_25">
        <input type="text" name="title" placeholder="titulo" required></input>
      </div>
      <div class="p_25">
        <textarea name="plot" cols="22" rows="10" placeholder="descripcion"></textarea>
      </div>
      <div class="p_25">
        <input type="text" name="author" placeholder="autor"></input>
      </div>
      <div class="p_25">
        <input type="text" name="actors" placeholder="actores"></input>
      </div>
      <div class="p_25">
        <input type="text" name="country" placeholder="pais"></input>
      </div>
      <div class="p_25">
        <input type="text" name="premiere" placeholder="estreno" required></input>
      </div>
      <!-- Se valida que se introduzca una "URL" -->
      <div class="p_25">
        <input type="url" name="poster" placeholder="poster"></input>
      </div>
      <div class="p_25">
        <input type="url" name="trailer" placeholder="trailer"></input>
      </div>
      <div class="p_25">
        <input type="number" name="rating" placeholder="rating" required></input>
      </div>
      <div class="p_25">
        <input type="text" name="genres" placeholder="generos" required></input>
      </div>
      <div class="p_25">
        <select name="status" placeholder="status" required>
          <option value ="">status</option>
          %s
        </select>
      </div>
      <div class="p_25">
        <input type="radio" name="category" id="movie" value="Movie" required>
        <label for="movie">Movie</label>
        <input type="radio" name="category" id="serie" value="Serie" required>
        <label for="serie">Serie</label>      
      </div>
      <div class = "p_25">
        <input class="button add" type="submit" value = "Agregar">
        <input type="hidden" name="r" value="movieserie-add">
        <input type="hidden" name="crud" value="set">
      </div>
    </form>
    ',$status_select);


}else if (($_POST['r'] == 'movieserie-add') && ($_SESSION['role'] == "Admin") && ($_POST['crud'] == "set"))
{
  // Se programara la insercción de datos, es decir alta de Usuarios.
  $ms_controller = new MovieSeriesController();
  // $_POST[status] = viene del formulario anterior, ya que se autoejecuta, no tiene la instruccion
  // "Action" del formulario.
  $new_ms = array(
    'imdb_id'=>$_POST['imdb_id'],
    'title'=>$_POST['title'],
    'plot'=>$_POST['plot'],    
    'author'=>$_POST['author'],
    'actors'=>$_POST['actors'],
    'country'=>$_POST['country'],
    'premiere'=>$_POST['premiere'],
    'poster'=>$_POST['poster'],
    'trailer'=>$_POST['trailer'],
    'rating'=>$_POST['rating'],
    'genres'=>$_POST['genres'],
    'status'=>$_POST['status'],
    'category'=>$_POST['category']
  );

  // Esta linea la graba a la base de datos.
  $ms = $ms_controller->set($new_ms);
  $template = '
    <div class = "container">
      <p class="item add">MovieSerie <b>%s</b> salvada</p>
    </div>      
    <script>
      window.onload = function(){
          reloadPage("movieseries") // Esta funcion se encuentra en el archivo "mexflix.js"
                                // se utiliza para recargar la página de "status" despues de 3 seg. 
          
        }

    </script>
  ';
  printf($template,$_POST['title']);
}
else // if ($_POST['r'] == 'user- add' && $_SESSION['role'] == "Admin")
{
  // Genera la vista de Usuario NO autorizado.
  $controller = new ViewController();
  $controller->load_view('error401');
  
}


?>