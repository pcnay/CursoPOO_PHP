<?php
  // ESte archivo contiene el programa para cargar todas las clases que necesiten los modulos.
  // Carga dinámica de todos los archivos.
  require_once ('./Controller/autoload.php');
  // Carga todas las clases necesarias, ya que se define el constructor.
  $autoload = new Autoload();

  // isset = Determina si existe la variable.
  $router = isset($_GET['r'])?$_GET['r']:'home';
  $mexflix = new Router($router);

?>
