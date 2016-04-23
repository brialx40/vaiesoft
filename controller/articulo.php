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

require "../model/articulo.php";

$art = new articulo();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar articulo
{
    $articulo=array();
    $articulo[0]=$_POST['id_proyecto'];
    $articulo[1]=$_POST['titulo'];  
    $articulo[2]=$_POST['autor'];
    $articulo[3]=$_POST['pagina_inicial'];
    $articulo[4]=$_POST['pagina_final'];
    $articulo[5]=$_POST['doi'];
    $articulo[6]=$_POST['ano_lectivo'];    
    $articulo[7]=$_POST['mes'];
    $articulo[8]=$_POST['categoria'];
    $articulo[9]=$_POST['nombre_revista'];
    $articulo[10]=$_POST['volumen'];
    $articulo[11]=$_POST['numero'];
    $articulo[12]=$_POST['issn'];
    $articulo[13]=$_POST['indice_bibliografico'];
    $articulo[14]=$_POST['url'];

   if($art->agregarArticulo($articulo)){
      echo "<script> alert (\"Se registro el articulo correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar el articulo. Ya existe en el Sistema. \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/articulo/index.php?id=$articulo[0]\"; </script>";         

    
die();
}   

if($opcion==2)//Editar articulo
{
    $articulo=array();
    $articulo[0]=$_POST['titulo'];  
    $articulo[1]=$_POST['autor'];
    $articulo[2]=$_POST['pagina_inicial'];
    $articulo[3]=$_POST['pagina_final'];
    $articulo[4]=$_POST['doi'];
    $articulo[5]=$_POST['ano_lectivo'];    
    $articulo[6]=$_POST['mes'];
    $articulo[7]=$_POST['categoria'];
    $articulo[8]=$_POST['nombre_revista'];
    $articulo[9]=$_POST['volumen'];
    $articulo[10]=$_POST['numero'];
    $articulo[11]=$_POST['issn'];
    $articulo[12]=$_POST['indice_bibliografico'];
    $articulo[13]=$_POST['url'];
    $articulo[14]=$_POST['id_articulo']; 
    $articulo[15]=$_POST['id_proyecto'];     
    
    if($art->editarArticulo($articulo[14], $articulo))
      echo "<script> alert (\"Se actualizo la informacion del articulo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del articulo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/articulo/index.php?id=$articulo[15]\"; </script>";
die();
}

if($opcion==3)//Eliminar articulo
{
    $id = $_POST['id'];
    $articulo=$art->buscarArticulo($id);
    if($art->eliminarArticulo($id))
      echo "<script> alert (\"Se elimino la informacion del articulo correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del articulo.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/producto/articulo/index.php?id=$articulo['id_proyecto']\"; </script>";
die();
}


?>
