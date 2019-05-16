<?php

include "index.php";

class Employee extends Persona
{
   
   public $numero;


function __construct($numero, $nombre, $profesion)
{
    parent::__construct($nombre, $profesion);
	$this->numero = $numero;

}



    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }
}




?>