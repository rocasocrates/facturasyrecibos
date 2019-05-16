<?php
class Persona
{
	public $nombre;
	public $profesion;



function __construct($nombre, $profesion)
{
	$this->nombre = $nombre;
	$this->profesion = $profesion;

}

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getProfesion()
    {
        return $this->profesion;
    }

    /**
     * @param mixed $profesion
     *
     * @return self
     */
    public function setProfesion($profesion)
    {
        $this->profesion = $profesion;

        return $this;
    }
}




?>