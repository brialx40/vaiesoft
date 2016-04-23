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

require "../model/capitulo_libro.php";

$lib = new capitulo_libro();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar capitulo_libro
{
    $capitulo_libro=array();
    $capitulo_libro[0]=$_POST['id_proyecto'];
    $capitulo_libro[1]=$_POST['titulo_libro'];
    $capitulo_libro[2]=$_POST['titulo_capitulo'];  
    $capitulo_libro[3]=$_POST['isbn'];
    $capitulo_libro[4]=$_POST['fecha'];
    $capitulo_libro[5]=$_POST['autor'];
    $capitulo_libro[6]=$_POST['editorial'];
    $capitulo_libro[7]=$_POST['lugar_publicacion'];    
    
   if($lib->agregarCapituloLibro($capitulo_libro)){
      echo "<script> alert (\"Se registro el capitulo del libro correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar el capitulo del libro. Ya existe en el Sistema. \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/capitulo_libro/index.php?id=$capitulo_libro[0]\"; </script>";         

    
die();
}   

if($opcion==2)//Editar capitulo_libro
{
    $capitulo_libro=array();
    $capitulo_libro[0]=$_POST['titulo_libro'];
    $capitulo_libro[1]=$_POST['titulo_capitulo'];  
    $capitulo_libro[2]=$_POST['isbn'];
    $capitulo_libro[3]=$_POST['fecha'];
    $capitulo_libro[4]=$_POST['autor'];
    $capitulo_libro[5]=$_POST['editorial'];
    $capitulo_libro[6]=$_POST['lugar_publicacion'];  
    $capitulo_libro[7]=$_POST['id_capitulo']; 
    $capitulo_libro[8]=$_POST['id_proyecto'];
    
    
    if($lib->editarCapituloLibro($capitulo_libro[7], $capitulo_libro))
      echo "<script> alert (\"Se actualizo la informacion del capitulo del libro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del capitulo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/capitulo_libro/index.php?id=$capitulo_libro[8]\"; </script>";
die();
}

if($opcion==3)//Eliminar capitulo_libro
{
    $id = $_POST['id'];
    $capitulo=$lib->buscarCapituloLibro($id);
    $id_proyecto =$capitulo['id_proyecto'];
    if($lib->eliminarCapituloLibro($id))
      echo "<script> alert (\"Se elimino la informacion del capitulo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del capitulo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/capitulo_libro/index.php?id=$id_proyecto\"; </script>";
die();
}


?>
