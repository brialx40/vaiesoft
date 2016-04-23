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

require "../model/contrapartida.php";

$con = new contrapartida();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar contrapartida
{
    $contrapartida=array();
    $contrapartida[0]=$_POST['nombre'];
    $contrapartida[1]=$_POST['estado'];
        
    if($con->agregarContrapartida($contrapartida)){
      echo "<script> alert (\"Se registro el rubro correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar el rubro. Ya existe en el Sistema \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/rubro/index.php\"; </script>";         

    
die();
}

if($opcion==2)//Editar contrapartida
{
    $contrapartida=array();
    $contrapartida[0]=$_POST['nombre'];
    $contrapartida[1]=$_POST['estado'];
    $contrapartida[2]=$_POST['id_contrapartida'];
    
    
    if($con->editarContrapartida($contrapartida[2], $contrapartida))
      echo "<script> alert (\"Se actualizo la informacion del rubro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del rubro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/rubro/index.php\"; </script>";
die();
}

if($opcion==3)//Eliminar contrapartida
{
    $id = $_POST['id'];
    if($con->eliminarContrapartida($id))
      echo "<script> alert (\"Se elimino la informacion del rubro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del rubro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/rubro/index.php\"; </script>";
die();
}

?>
