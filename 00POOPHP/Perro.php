<?php
/*
Los nombre de archivo deben ser con el nombre de la clase, como se define este caso.

Modificadores de Acceso:
public:
  Accesa desde cualquier método de la clase u objeto que lo invoque
private:
  Accesa solo de los métodos de la clase, los objetos no pueden ser invocados
protected:
  Accesa solo desde los métodos de la clase y de las subclases que heredan

*/
class Perro
{
  // Definiendo Atributos(propiedades)
  public $nombre;
  public $raza;
  public $edad;
  public $sexo;
  public $adiestrado;
  public $foto;
  public $comida;
  private $pulgas;
  public static $mejor_amigo = "Hombre";
  const MEJOR_CUALIDAD = "Fidelidad"; // Definiendo una constante.


  /* Métodos mágicos:
  CONSTRUCTOR:
    Método que se ejecuta automáticamente al inicio de instanciar la clase
  DESTRUCTOR:
    Método que se ejecuta automáticamente al final de instanciar la clase
  */
  public function __construct($n,$r,$e,$s,$a,$f,$p)
  {
    printf("<mark>Hola Soy El Constructor De La Clase</mark>");
    $this->nombre = $n;
    $this->raza = $r;
    $this->edad = $e .' años'; // "$r años", imprime =  3 años; '$r años', imprime = $r años
    $this->sexo = ($e) ? 'Macho' : 'Hembra';
    $this->adiestrado = ($a) ? 'Adiestrado' : 'NO Adiestrado';
    $this->foto = $f;
    $this->pulgas = $p;
    
  }

  public function __destruct()
  {
    printf("<p><mark>Adíos Soy El Destructor De La Clase</mark></p>");
  }

  // Definiendo Métodos
  public function ladrar()
  {
    printf("<p><mark>GUA GUA !!! </mark></p>");
  }

  public function comer($comida)
  {
    $this->comida = $comida;
    printf ("<p>".$this->nombre." come ".$this->comida."</p>");
  }

  public function aparecer()
  {
    printf('<img src ="'.$this->foto.'">');
  }

  // Para Accesar al atributo privado, se tiene que definir un metodo para que llame al
  // atributo.
  public function tiene_pulgas()
  {
    printf(($this->pulgas)?"<p>Tiene Pulgas</p>":"<p>NO tiene Pulgas</p>");
  }

  public function mas_Info()
  {
    $this->ladrar();
    self::ladrar(); // utilizando el operador de ámbito.
    Perro::comer('Hueso');
    // Perro::$nombre;  NO se puede llamar atributos por esta forma.

    // Una vez definida la variable como estatica
    printf("<p>El Mejor Amigo Del Perro es ".Perro::$mejor_amigo."</p>");
    // Desplegando variables, atributos constantes.
    printf("<p>La Mejor cualidad del perro es ".Perro::MEJOR_CUALIDAD."</p>");
    printf("<p>La Mejor cualidad del perro es ".self::MEJOR_CUALIDAD."</p>");
  }
}
// Instanciar un objeto de la clase.
// Estos parámetros que se pasan se definen en el constructor.
$kenai = new Perro('kenai','Firefox',3,true,true,'http://jonmircha.github.io/slides-poo-js/img/kenai.jpg',false);
// var_dump($kenai); // permite analizar la estructura del objeto.

printf("<h1>".$kenai->nombre."</h1>");
printf("<h2>".$kenai->raza."</h2>");
printf("<h3>".$kenai->edad."</h3>");
printf("<h4>".$kenai->sexo."</h4>");
printf("<h5>".$kenai->adiestrado."</h5>");
printf("<h6>".$kenai->foto."</h6>"); // solo muestra la ruta donde se encuentra la foto.

$kenai->ladrar();
$kenai->comer('croketa');
$kenai->comer('tacos');
$kenai->aparecer(); // Muestra la foto del perro.
$kenai->tiene_pulgas();
$kenai->mas_Info(); // Se esta llamando de nuevo al método.
?>