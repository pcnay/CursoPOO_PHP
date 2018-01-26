<?php 
  class Telefono
  {
    public $marca;
    public $modelo;
    // Pueden ser accesados por la clases hijas
    protected $alambrico = true;
    protected $comunicacion;

    // Cuando inicilize el objeto pedira los datos.
    public function __construct($marca,$modelo)
    {
      $this->marca = $marca;
      $this->modelo = $modelo;
      $this->comunicacion = ($this->alambrico) ? 'Alambrica':'Inalambrica';
    }

    //Definiendo los métodos de la clase
    public function llamar()
    {
      $mensaje = printf("<p>Riiiing Riiiing !!! </p>");
      // return printf("<p>Riiiing Riiiing !!! </p>");
      return $mensaje;
    }
    public function mas_info()
    {
      $informacion = printf('<ul>
      <li>Marca  : <b>'.$this->marca.'</b></li>
      <li>Modelo : <b>'.$this->modelo.'</b></li>
      <li>Comunicacion : <b>'.$this->comunicacion.'</b></li>
      </ul>');      
      return $informacion;
  /*    
      return printf("<ul>
        <li>Marca <b>'.$this->marca.'</b></li>
        <li>Modelo <b>'.$this->modelo.'</b></li>
        <li>Comunicacion <b>'.$this->comunicacion.'</b></li>
        </ul>");
*/        
    }

  }

  // Se inicia la herecia
  class Celular extends Telefono
  {
    protected $alambrico = false;
    public function __construct($marca,$modelo)
    {
      // llamando el constructor padre.
      // :: Operador de resolucion de ámbito
      parent::__construct($marca,$modelo);
    }
  }

  // Es una clase final, ya que no hay evolución del celular
  // Por lo que no puede heredar esta clase.
  final class SmarthPhone extends Celular
  {
    public $alambrico = false;
    public $internet = true;
    
    public function __construct($marca,$modelo)
    {
      parent::__construct($modelo,$marca);
    
    }
    // PHP busca primero en la clase original si existe el método, si no lo encuentra
    // pasa a la clase superior (desde donde lo hereda), si no lo encuentra sube al 
    // siguiente nivel.
    public function mas_info()
    {
      $informacion = printf('<ul>
      <li>Marca  : <b>'.$this->marca.'</b></li>
      <li>Modelo : <b>'.$this->modelo.'</b></li>
      <li>Comunicacion : <b>'.$this->comunicacion.'</b></li>
      <li>Dispositivo con Acceso a Internet </li>
      </ul>');      
      return $informacion;
    }
    
  }

  printf("<h1>Evolución del Teléfono </h1>");
  printf("<h2>Teléfono :</h2>");
  $tel_casa = new Telefono("Panasonic","KX-TS550");
  $tel_casa->llamar();
  $tel_casa->mas_info();

  printf("<h2>Celular :</h2>");
  $mi_Cel = new Celular("Nokia","5120");
  // Se heredan los métodos del padre en la clase heredada de Celular.
  $mi_Cel->llamar();
  $mi_Cel->mas_info();

  printf("<h2>SmarthPhone :</h2>");
  $mi_sp = new SmarthPhone("Motorola","G3");
  // Se heredan los métodos del padre en la clase heredada de Celular.
  $mi_sp->llamar();
  $mi_sp->mas_info();

?>