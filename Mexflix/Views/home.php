<?php

$template = '
  <article class = "item"> 
    <h2 class = "p1">Hola %s, Bienvenido(a) a Mexflix </h2>
    <h3 class = "p1">Tus Peliculas y Series favoritas </h3>
    <p class = "p1 f1_25">Tu nombre es : <b>%s</b><p>
    <p class = "p1 f1_25">Tu email es : <b>%s</b><p>
    <p class = "p1 f1_25">Tu Cumpleaños es : <b>%s</b></p>
    <p class = "p1 f1_25">Tu Perfil de Usuario es : <b>%s</b></p>
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
