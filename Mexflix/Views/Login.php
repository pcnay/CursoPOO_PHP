<?php
printf('
  <!-- Se devide en dos partes este archivo "header.php" y "footer.php" para agregarse como archivo -->

    <!-- Esta sección es la que esta cambiando. es por esta razon que se deja en este archivo.-->
      <!-- Se define la clase para el "responsimple", de lo contrario no se veria.-->

  <!-- Este nombre de clase es desde la libreria "responsimple"-->
  <form class = "item" method = "post">
    <!-- padding de 0.25 rem a los lados-->
    <div class = "p_25">
      <input type = "text" name = "user" placeholder="usuario" required>
    </div>
    <div class = "p_25">
      <input type = "password" name = "pass" placeholder="password" required>
    </div>
    <div class = "p_25">
      <input type="submit" class="button" value = "Enviar">
      <!-- Cuando se oprima el boton "Enviar", se generan dos variables SuperGloables 
      es de tipo POST porque en la definición de la formulario se establecio $_POST[user],
      $_POST[ pass] que pueden ser accesadas en cualquier parte de los módulos de la aplicación. 
      -->
    </div>
    
  </form>
');
  // Esta variable se asigno en Router.php, en el comando "header".  
  // si $_GET existe 
  // Como se recarga la página y se encuentra definada la variable "error"  
  if(isset($_GET['error'])) 
  { 
    $template = '
      <div class = "container">
        <p class= "item  error">%s</p>
      </div>';
      // Imprime una cadena de texto y reemplaza los comodines.
    printf ($template,$_GET['error']);
  } 

?>
