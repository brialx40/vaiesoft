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

require "../model/consultoria.php";

$con = new consultoria();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar consultoria
{
    $consultoria=array();
    $consultoria[0]=$_POST['id_proyecto'];
    $consultoria[1]=$_POST['titulo'];  
    $consultoria[2]=$_POST['numero_contrato'];
    $consultoria[3]=$_POST['fecha'];
    
   if($con->agregarConsultoria($consultoria)){
      echo "<script> alert (\"Se registro la consultoria cientifico tecnologica correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar la consultoria. Ya existe en el Sistema. \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/consultoria/index.php?id=$consultoria[0]\"; </script>";         

    
die();
}   

if($opcion==2)//Editar consultoria
{
    $consultoria=array();
    $consultoria[0]=$_POST['id_proyecto'];
    $consultoria[1]=$_POST['titulo'];  
    $consultoria[2]=$_POST['numero_contrato'];
    $consultoria[3]=$_POST['fecha'];
    $consultoria[4]=$_POST['id_consultoria']; 
    
    
    if($con->editarConsultoria($consultoria[7], $consultoria))
      echo "<script> alert (\"Se actualizo la informacion de la consultoria cientifico tecnologica correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion de la consultoria.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/consultoria/index.php?id=$consultoria[0]\"; </script>";
die();
}

if($opcion==3)//Eliminar consultoria
{
    $id = $_POST['id'];
    $consultoria=$con->buscarConsultoria($id);
    if($con->eliminarConsultoria($id))
      echo "<script> alert (\"Se elimino la informacion de la consultoria cientifico tecnologica correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion de la consultoria.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/consultoria/index.php?id=$consultoria['id_proyecto']\"; </script>";
die();
}


?>
