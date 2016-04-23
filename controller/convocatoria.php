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

require "../model/convocatoria.php";

$conv = new convocatoria();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar convocatoria
{
    $convocatoria=array();
    $convocatoria[0]=$_POST['nombre'];
    $convocatoria[1]=$_POST['ano_lectivo'];
    $convocatoria[2]=$_POST['fechaInicio'];
    $convocatoria[3]=$_POST['fechaFin'];
    $convocatoria[4]=$_POST['estado'];
    
    
    if($conv->agregarConvocatoria($convocatoria)){
      echo "<script> alert (\"Se registro la convocatoria Correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar la convocatoria. Ya existe en el Sistema \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/convocatoria\"; </script>";         

    
die();
}

if($opcion==2)//Editar convocatoria
{
    $convocatoria=array();
    $convocatoria[0]=$_POST['nombre'];
    $convocatoria[1]=$_POST['ano_lectivo'];
    $convocatoria[2]=$_POST['fechaInicio'];
    $convocatoria[3]=$_POST['fechaFin'];
    $convocatoria[4]=$_POST['estado'];
    $convocatoria[5]=$_POST['id_convocatoria'];
    
    
    if($conv->editarConvocatoria($convocatoria[5], $convocatoria))
      echo "<script> alert (\"Se actualizo la informacion de la convocatoria correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion de la convocatoria.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/convocatoria\"; </script>";
die();
}

if($opcion==3)//Eliminar convocatoria
{
    $id = $_POST['id'];
    if($conv->eliminarConvocatoria($id))
      echo "<script> alert (\"Se elimino la informacion de la convocatoria correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion de la convocatoria.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/convocatoria\"; </script>";
die();
}

?>
