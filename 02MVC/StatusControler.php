 <?php
 require ('StatusModel.php');

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

   public function create ($status_data = array() )
   { 
     // Accesa a los métodos de la clase "statusModel", en el constructor se instancio la clase.
    return $this->model->create($status_data);
   }

   public function read ($status_id = '' )
   {
    return $this->model->read($status_id);
   }
   public function update ($status_data = array() )
   {
    return $this->model->update($status_data);
   }
   public function delete ($status_id = '' )
   {
    return $this->model->delete($status_id);
   }

 }
 ?>