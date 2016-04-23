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

require "../model/grupo.php";

$gru = new grupo();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar grupo
{
    $grupo=array();
    $grupo[0]=$_POST['siglas'];
    $grupo[1]=$_POST['nombre'];    
    $grupo[2]=$_POST['facultad'];
        
    if($gru->agregarGrupo($grupo)){
      echo "<script> alert (\"Se registro el grupo Correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar el grupo. Ya existe en el Sistema \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/grupo\"; </script>";         

    
die();
}

if($opcion==2)//Editar grupo
{
    $grupo=array();
    $grupo[0]=$_POST['siglas'];
    $grupo[1]=$_POST['nombre'];
    $grupo[2]=$_POST['facultad'];
    $grupo[3]=$_POST['id_grupo'];
    
    
    if($gru->editarGrupo($grupo[3], $grupo))
      echo "<script> alert (\"Se actualizo la informacion del grupo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del grupo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/grupo\"; </script>";
die();
}

if($opcion==3)//Eliminar grupo
{
    $id = $_POST['id'];
    if($gru->eliminarGrupo($id))
      echo "<script> alert (\"Se elimino la informacion del grupo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del grupo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/grupo\"; </script>";
die();
}

?>
