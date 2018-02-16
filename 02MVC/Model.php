<?php
// Clase Abstracta que nos permitira conectarnos a la Base De Datos.

  abstract class Model
  {
    // Atributos 
    // private static = Se define como privado(solo esta clase lo accesa) y no cambia . 
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = '';
    private static $db_name;
    protected $db_name;
    private static $db_charset = 'utf-8';
    private $conn;
    protected $query;
    protected $rows = array();

    // Métodos
    // Solo se coloca el nombre pero se implementan en las clases hijas donde se hereden.
    // Operaciones CRUD.
    abstract protected function create();
    abstract protected function read();
    abstract protected function update();
    abstract protected function delete();

    // Privado ya que solo este tiene la conexion a MySQL.
    private function db_open()
    {
                              // $this->db_host 
                              // self:: = porque se definio como private y static
      $this->conn = new mysqli(
        self::$db_host,
        self::$db_user,
        self::$db_pass,
        $this->db_name);
        //http://php.net/manual/es/mysqli.set-charset.php
        $this->conn = set_charset(self::$db_charset)
    }
    // Privado ya que solo este tiene la desconexion a MySQL.
    private function db_close()
    {
      $this->conn->close();
    }
    // Establecer un query que afecte datos (INSERT, DELETE, UPDATE)
    // solo Indica si se ejecuto la peticion CRUD.
    // Se veran afectados los datos en la Base de Datos
    protected function set_query()
    {
      $this->db_open();
      //http://php.net/manual/es/mysqli_query.php
      $this->conn->query($this->query);
      $this->db_close();
    }

    // Obtener datos de un "query" consulta de tipo SELECT en un Array.
    protected function get_query()
    {
      $this->db_open();
      $result = $this->conn->query($this-query);
      // fetch_assoc = Retorna el contenido de un reg. por el nombre de campo.
      http://mx1.php.net/manual/en/mysqli-result.fetch-assoc.php
      while ( $this->rows[]=$result->fetch_assoc() );
      $result->close();

      $this->db_close();

      return $this->rows;
    }
    

  }

?>
