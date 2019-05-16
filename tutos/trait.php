<?php

trait Persona
{
	public $nombre;

	public function mostrarNombre()
	{
		echo $this->nombre;
	}

	abstract function asignarNombre($nombre);
}

class ClasePersona
{
	use Persona;

	public function asignarNombre($nombre)
	{
		$this->nombre = $nombre;
	}
}

$persona = new ClasePersona();
$persona->asignarNombre("Roca");
$persona->mostrarNombre();

?>