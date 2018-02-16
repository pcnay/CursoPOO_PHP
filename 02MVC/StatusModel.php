<?php
require_once('Model.php');

class StatusModel extends Model
{
  public $status_id;
  public $status;

  public function __construct()
  {
    // Este atributo es de la clase "Model", esta definido como protected pero si lo puede
    // accesar ya que lo hereda.
    $this->db_name = 'mexflix';    
  }

  public function __destruct()
  {
  //  unset($this);
  }

  // Definiendo los metodos que se declararon en la clase "Model"
  public function create()
  {
  
  }
  // Si no se pasa parámetro le asigna un caracter en blanco.
  public function read($status_id = '')
  {
    $this->query = $sql = ($status_id != '')
    ?"SELECT * FROM status WHERE status_id = $status_id "
    :"SELECT * FROM status";

    /*
    if (status_id != '')
    {
      $sql = "SELECT * FROM status WHERE status_id = $status_id ";
    }
    else
    {
      $sql = "SELECT * FROM status";
    }
    */
    // Es un atributo de la clase "Model", no es el método del Objeto conexion MySQL.
    
    $this->get_query();
    // Analiza el objeto, para este caso es un arreglo, y es mostrado en pantalla.
    // console.log de JavaScript.
    //var_dump($this->rows); 

    // Se inicia la seccion para desplegar los datos en "StatusView.php"
    // Cuando se escribe return y posteriormente se escribe mas código, este sera ignorado.
    //return $this->rows;

    // retorna el número de elementos que tiene el arreglo.
    $num_rows = count($this->rows);

    $data = array();
    // Vaciar el contenido del Arreglo protegido($this->rows) de la clase a un
    // nuevo arreglo, llamado "$data".
    // "foreach "Permite recorre un arreglo de una forma mas optimizada
    // http://mx1.php.net/manual/en/control-structures.foreach.php
    foreach ($this->rows as $key => $value)
    {
      // Agrega al final una nueva posicion.
      //array_push($data,$value);
      $data[$key] = $value;      
    }

    return $data;
  }
  public function update()
  {
  
  }
  public function delete()
  {
  
  }

}
?>