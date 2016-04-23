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

require "../model/software.php";

$soft = new software();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar software
{
    $software=array();
    $software[0]=$_POST['id_proyecto'];
    $software[1]=$_POST['titulo'];  
    $software[2]=$_POST['numero_registro'];
    $software[3]=$_POST['ano_lectivo'];
    $software[4]=$_POST['descripcion'];
   
   if($soft->agregarSoftware($software)){
      echo "<script> alert (\"Se registro el software correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar el software. Ya existe en el Sistema. \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/software/index.php?id=$software[0]\"; </script>";         

    
die();
}   

if($opcion==2)//Editar software
{
    $software=array();
    $software[0]=$_POST['id_proyecto'];
    $software[1]=$_POST['titulo'];  
    $software[2]=$_POST['numero_registro'];
    $software[3]=$_POST['ano_lectivo'];
    $software[4]=$_POST['descripcion'];
    $software[5]=$_POST['id_software']; 
    
    
    if($soft->editarSoftware($software[7], $software))
      echo "<script> alert (\"Se actualizo la informacion del software correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del software.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/software/index.php?id=$software[0]\"; </script>";
die();
}

if($opcion==3)//Eliminar software
{
    $id = $_POST['id'];
    $software=$soft->buscarSoftware($id);
    if($soft->eliminarSoftware($id))
      echo "<script> alert (\"Se elimino la informacion del software correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del software.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/software/index.php?id=$software['id_proyecto']\"; </script>";
die();
}


?>
