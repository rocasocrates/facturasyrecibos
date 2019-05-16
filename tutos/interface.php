<?php 


interface Auto 
{
	public function encender();
	public function apagar();
}

interface gasolina extends Auto
{
	public function vaciarTanque();
	public function llenarTanque($cantidad);
}

class Deportivo implements gasolina {
public function ver()
	{
		echo "Hola";
	}
	public function encender(){}
	public function apagar(){}
	public function vaciarTanque(){}
	public function llenarTanque($cantidad){}
}
$obj = new Deportivo();
$obj->ver();
?>