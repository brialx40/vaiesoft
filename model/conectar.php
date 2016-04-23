<?php

$host="localhost";
$user="root";
$clave="";
$db="proyectofinu";


$conxhost=mysql_connect($host,$user,$clave);
	if($conxhost){
		$selectdb=mysql_select_db($db,$conxhost);
		if(!$selectdb){ 
			echo "Error al seleccionar la Base de Datos de nombre: ".$db." ".mysql_error();  	
		}
	}

	else {
     	echo "Error al Conectarse con el Host".mysql_error();  					
	}
?>
