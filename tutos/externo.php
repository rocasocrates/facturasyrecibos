<?php
include "empleado.php";

class Externo extends Employee
{
	public $cif;

	function __construct($cif, $numero, $nombre, $profesion)
	{
		parent::__construct($numero,$nombre,$profesion);
		
		$this->cif = $cif;
	}


}

$negocio = new Externo(4888, 5, "Jesus", "gerente");
echo $negocio->getNombre()."<br>";
echo $negocio->getNumero()."<br>";
echo $negocio->getProfesion();

?>