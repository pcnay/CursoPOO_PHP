<?php
// require_once('Model.php');
// Se utilizara una clase para cargar lo que se necesita.


class StatusModel extends Model
{
  public function __destruct()
  {
  //  unset($this);
  }

  // Definiendo los metodos que se declararon en la clase "Model"
  // Se le indica a PHP que el valor que recibe es un arreglo
  public function set($status_data = array())
  {
    foreach ($status_data as $key =>$value)
    {
      // http://php.net/manual/es/lenguaje.variable.variable.php
      // Se convierte a Variable.
      //Ya que "$key" es una llave del arreglo asociativo, y con $$key se convierte a Variable
      $$key = $value;

    }
    $this->query = "REPLACE INTO status (status_id,status) VALUES ($status_id,'$status')";
    $this->set_query();
  }


  // Si no se pasa parámetro le asigna un caracter en blanco.
  public function get($status_id = '')
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

  public function del($status_id = '')  
  {
    $this->query = "DELETE FROM status WHERE status_id = $status_id";
    $this->set_query();

  }

}
?>