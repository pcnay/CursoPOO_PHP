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
    <input type = "submit" class = "botton" value = "Enviar">
    <!-- Cuando se oprima el boton "Enviar", se generan dos variables SuperGloables 
    es de tipo POST porque en la definición de la formulario se establecio $_POST['user'],
     $_POST['pass'] que pueden ser accesadas en cualquier parte de los módulos de la aplicación. 
    -->
  </div>
  
</form>
<?php
  // Esta variable se asigno en Router.php, en el comando "header".  
  // si $_GET existe 
  // Como se recarga la página y se encuentra definada la variable "error"  
  if(isset($_GET['error'])) { ?>
  <div class = "container">
    <p class= "item  error"><?php printf($_GET['error']); ?></p>
  </div>
<?php } // El cierre del if ?>
<?php
if(isset($_GET['validando'])) { ?>
  <div class = "container">
    <p class= "item  error"><?php printf($_GET['validando']); ?></p>
  </div>
<?php } // El cierre del if ?>

