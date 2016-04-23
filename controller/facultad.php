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

require "../model/facultad.php";

$fac = new facultad();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar facultad
{
    $facultad=array();
    $facultad[0]=$_POST['nombre'];
    
    if($fac->agregarFacultad($facultad)){
      echo "<script> alert (\"Se registro la facultad correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar la facultad. Ya existe en el Sistema \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/facultad\"; </script>";         

    
die();
}

if($opcion==2)//Editar facultad
{
    $facultad=array();
    $facultad[0]=$_POST['nombre'];
    $facultad[1]=$_POST['id_facultad'];
    
    
    if($fac->editarFacultad($facultad[1], $facultad))
      echo "<script> alert (\"Se actualizo la informacion de la facultad correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion de la facultad.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/facultad\"; </script>";
die();
}

if($opcion==3)//Eliminar facultad
{
    $id = $_POST['id'];
    if($fac->eliminarFacultad($id))
      echo "<script> alert (\"Se elimino la informacion de la facultad correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion de la facultad.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/facultad\"; </script>";
die();
}

?>
