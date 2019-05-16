<?php

require('./vendor/autoload.php');

$faker = Faker\Factory::create();

for ($i=0; $i < 20; $i++) { 
	
	echo $faker->name . "<br/>";

}


  ?>