 <?php
//  require ('StatusModel.php');
// Se carga las clases .

 class MovieSeriesController
 {
   public function __construct()
   {
      $this->model = new MovieSeriesModel();
   }

   public function __destruct()
   {  
     //unset($this); 
   }

   private $model;

   public function set ($ms_data = array() )
   { 
     // Accesa a los métodos de la clase "MovieSeriesModel", en el constructor se instancio la clase.
    return $this->model->set($ms_data);
   }

   public function get($ms = '' )
   {
    return $this->model->get($ms);
   }
   public function del ($ms = '' )
   {
    return $this->model->del($ms);
   }

 }
 ?>