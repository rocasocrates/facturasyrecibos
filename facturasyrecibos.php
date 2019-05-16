<?php

class FacturayRecibo
{
	public $numfactura;
	public $dni;
	public $nombre;
	public $apellidos;
	public $direccion;
	public $cp;
	public $localicad;
	public $fecha;
	public $serie;
	public $idparte;
	public $siniestro;
	public $importe;
	public $estado;


	/**
	 * Class Constructor
	 * @param    $numfactura   
	 * @param    $dni   
	 * @param    $nombre   
	 * @param    $apellidos   
	 * @param    $direccion   
	 * @param    $cp   
	 * @param    $localicad   
	 * @param    $fecha   
	 * @param    $serie   
	 * @param    $idparte   
	 * @param    $siniestro   
	 * @param    $importe   
	 * @param    $estado   
	 */
	public function __construct($numfactura = null, $dni, $nombre = null, $apellidos = null, $direccion = null, $cp = null, $localicad, $fecha, $serie, $idparte, $siniestro, $importe = null, $estado = null)
	{
		$this->numfactura = $numfactura;
		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->direccion = $direccion;
		$this->cp = $cp;
		$this->localicad = $localicad;
		$this->fecha = $fecha;
		$this->serie = $serie;
		$this->idparte = $idparte;
		$this->siniestro = $siniestro;
		$this->importe = $importe;
		$this->estado = $estado;
	}



    /**
     * @return mixed
     */
    public function getNumfactura()
    {
        return $this->numfactura;
    }

    /**
     * @param mixed $numfactura
     *
     * @return self
     */
    public function setNumfactura($numfactura)
    {
        $this->numfactura = $numfactura;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     *
     * @return self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
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
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     *
     * @return self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     *
     * @return self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     *
     * @return self
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocalicad()
    {
        return $this->localicad;
    }

    /**
     * @param mixed $localicad
     *
     * @return self
     */
    public function setLocalicad($localicad)
    {
        $this->localicad = $localicad;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * @param mixed $serie
     *
     * @return self
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdparte()
    {
        return $this->idparte;
    }

    /**
     * @param mixed $idparte
     *
     * @return self
     */
    public function setIdparte($idparte)
    {
        $this->idparte = $idparte;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiniestro()
    {
        return $this->siniestro;
    }

    /**
     * @param mixed $siniestro
     *
     * @return self
     */
    public function setSiniestro($siniestro)
    {
        $this->siniestro = $siniestro;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * @param mixed $importe
     *
     * @return self
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}


 ?>