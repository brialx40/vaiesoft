<?php

/**
 * Description of registrar
 *
 * @author Diana Calderon
 */

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../index.php'; </script>";
   }

require "../model/ano_lectivo.php";

$anle = new ano_lectivo();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar ano_lectivo
{
    $ano_lectivo=array();
    $ano_lectivo[0]=$_POST['id_anle'];
    
    if($anle->agregarAnoLectivo($ano_lectivo)){
      echo "<script> alert (\"Se registro el año lectivo correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar del año lectivo. Ya existe en el Sistema \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/ano_lectivo\"; </script>";         

    
die();
}

if($opcion==2)//Editar ano_lectivo
{
    $ano_lectivo=array();
    $ano_lectivo[0]=$_POST['id_anle'];
        
    if($anle->editarAnoLectivo($ano_lectivo[5], $ano_lectivo))
      echo "<script> alert (\"Se actualizo la informacion de el año lectivo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del año lectivo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/ano_lectivo\"; </script>";
die();
}

if($opcion==3)//Eliminar ano_lectivo
{
    $id = $_POST['id'];
    if($anle->eliminarAnoLectivo($id))
      echo "<script> alert (\"Se elimino la informacion del año lectivo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del año lectivo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/ano_lectivo\"; </script>";
die();
}


?>
