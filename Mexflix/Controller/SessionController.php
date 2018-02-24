<?php 
  class SessionController
  {
    private $session;

    public function __construct()
    {
      // Valida si el usuario existe.
      $this->session = new UsersModel();
      // Si exite el usuario, se creara la sesion de usuario.

      
    }
    // Creara la sesión 
    // Es donde se hace los enlaces con las capas del MVC.
        // Capa Controller. que llama a la capa Modelo
    public function login($user,$pass)
    {
      // $this->session = Es la variable privada de la clase y se utiliza en el constructor
      // Valida usuario y password si existe en la base de datos.
      return $this->session->validate_user($user,$pass);
    }
    // Elimina la sesion
    public function logout()
    {

    }
    public function __destruct()
    {
      // unset($this);
    }
  }
?>
