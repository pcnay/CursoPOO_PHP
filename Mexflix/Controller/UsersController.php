 <?php
//  require ('StatusModel.php');
// Se carga las clases .

 class StatusControler
 {
   public function __construct()
   {
      $this->model = new StatusModel();
   }

   public function __destruct()
   {  
     //unset($this); 
   }

   private $model;

   public function set ($status_data = array() )
   { 
     // Accesa a los métodos de la clase "statusModel", en el constructor se instancio la clase.
    return $this->model->set($status_data);
   }

   public function get($status_id = '' )
   {
    return $this->model->get($status_id);
   }
   public function del ($status_id = '' )
   {
    return $this->model->del($status_id);
   }

 }
 ?>