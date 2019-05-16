<?php


       $fichero = 'gente.pdf';
// Abre el fichero para obtener el contenido existente
$actual = file_get_contents($fichero);
// Añade una nueva persona al fichero
$actual .= "hola caracola";
// Escribe el contenido al fichero
file_put_contents($fichero, $actual);

  ?>