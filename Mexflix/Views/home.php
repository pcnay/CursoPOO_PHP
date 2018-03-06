<?php

$template = '
  <article class = "item"> 
    <h2>Hola %s, Bienvenido(a) a Mexflix </h2>
    <h3>Tus Peliculas y Series favoritas </h3>
    <p>Tu nombre es : <b>%s</b><p>
    <p>Tu email es : <b>%s</b><p>
    <p>Tu Cumpleaños es : <b>%s</b></p>
    <p>Tu Perfil de Usuario es : <b>%s</b></p>
</article>';

printf($template,
      $_SESSION['user'],
      $_SESSION['name'],
      $_SESSION['email'],
      $_SESSION['birthday'],
      $_SESSION['role']
    );
    
    if(isset($_GET['validando'])) { ?>
      <div class = "container">
        <p class= "item  error"><?php printf($_GET['validando']); ?></p>
      </div>
    <?php } // El cierre del if ?>
    
 ?>
