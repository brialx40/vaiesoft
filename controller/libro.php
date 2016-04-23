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

require "../model/libro.php";

$lib = new libro();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar libro
{
    $libro=array();
    $libro[0]=$_POST['id_proyecto'];
    $libro[1]=$_POST['titulo'];  
    $libro[2]=$_POST['isbn'];
    $libro[3]=$_POST['fecha'];
    $libro[4]=$_POST['autor'];
    $libro[5]=$_POST['editorial'];
    $libro[6]=$_POST['lugar_publicacion'];    
    
   if($lib->agregarLibro($libro)){
      echo "<script> alert (\"Se registro el libro correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar el libro. Ya existe en el Sistema. \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/libro/index.php?id=$libro[0]\"; </script>";         

    
die();
}   

if($opcion==2)//Editar libro
{
    $libro=array();
    $libro[0]=$_POST['id_proyecto'];
    $libro[1]=$_POST['titulo'];  
    $libro[2]=$_POST['isbn'];
    $libro[3]=$_POST['fecha'];
    $libro[4]=$_POST['autor'];
    $libro[5]=$_POST['editorial'];
    $libro[6]=$_POST['lugar_publicacion']; 
    $libro[7]=$_POST['id_libro']; 
    
    
    if($lib->editarLibro($libro[7], $libro))
      echo "<script> alert (\"Se actualizo la informacion del libro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del libro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/libro/index.php?id=$libro[0]\"; </script>";
die();
}

if($opcion==3)//Eliminar libro
{
    $id = $_POST['id'];
    $libro=$lib->buscarLibro($id);
    if($lib->eliminarLibro($id))
      echo "<script> alert (\"Se elimino la informacion del libro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del libro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/libro/index.php?id=$libro['id_proyecto']\"; </script>";
die();
}


?>
