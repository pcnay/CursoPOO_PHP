 <?php
//  require ('StatusModel.php');
// Se carga las clases .

 class UsersController
 {
   public function __construct()
   {
      $this->model = new UsersModel();
   }

   public function __destruct()
   {  
     //unset($this); 
   }

   private $model;

   public function set ($user_data = array() )
   { 
     // Accesa a los métodos de la clase "usersModel", en el constructor se instancio la clase.
    return $this->model->set($user_data);
   }

   public function get($user_id = '' )
   {
    return $this->model->get($user_id);
   }
   public function del ($user_id = '' )
   {
    return $this->model->del($user_id);
   }

 }
 ?>