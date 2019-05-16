<?php 

class Persona
{
	public $nombre;


	function __construct($nombre = "Manuel")
	{
		$this->nombre = $nombre;
	}

	function getNombre()
	{
		return $this->nombre;
	}
}

$total = new Persona("Roca");

echo $total->getNombre();
?>