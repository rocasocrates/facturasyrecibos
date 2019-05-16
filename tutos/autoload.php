<?php




function autoload($fichero)
{
include $_GET['action']."/".$fichero.".php";
}
spl_autoload_register('autoload');

Auto::mostrar("soy auto");
Persona::mostrar("Soy persona");

  ?>