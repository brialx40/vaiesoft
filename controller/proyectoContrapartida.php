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

require "../model/ProyectoContrapartida.php";
require "../model/contrapartida.php";
require "../model/Proyecto.php";

$Pro = new Proyecto();
$proContrapartida = new ProyectoContrapartida();
$cont = new contrapartida();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar ProyectoContrapartida Rubro
{

    $ProyectoContrapartida= array();
    $ProyectoContrapartida[0]= $_POST['id_proyecto'];
    $ProyectoContrapartida[1]= $_POST['nombre'];
    $suma=0;
    $valores='';
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $valores=$valores.$i.','.$_POST[$valor].',';
           // $ProyectoContrapartida[2] =  ($i);
           // $ProyectoContrapartida[3] = $_POST[$valor];
            $suma+=$_POST[$valor];
              
          }
      }  
      $ProyectoContrapartida[2] =  $valores;
      $ProyectoContrapartida[3] = $suma; 

      if($proContrapartida->agregarProyectoContrapartida($ProyectoContrapartida)){
        echo "<script> alert (\"Se registro la contrapartida correctamente.  \"); </script>";
        echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$ProyectoContrapartida[0]\"; </script>";
      }    
    
      die();
}

if($opcion==2)//Editar ProyectoContrapartida
{
    $ProyectoContrapartida= array();
    $ProyectoContrapartida[0]= $_POST['id_proyecto'];
    $ProyectoContrapartida[1]= $_POST['nombre'];
    $suma=0;
    $valores='';
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $valores=$valores.$i.','.$_POST[$valor].',';
           // $ProyectoContrapartida[2] =  ($i);
           // $ProyectoContrapartida[3] = $_POST[$valor];
            $suma+=$_POST[$valor];
              
          }
      }  
      $ProyectoContrapartida[2] =  $valores;
      $ProyectoContrapartida[3] = $suma; 
      $ProyectoContrapartida[4]= $_POST['id_pru'];

      if($proContrapartida->editarProyectoContrapartida($ProyectoContrapartida[4], $ProyectoContrapartida)){
        echo "<script> alert (\"Se actualizo la contrapartida correctamente.  \"); </script>";
      }    
      else{
        echo "<script> alert (\"Error.. No se actualizo la contrapartida correctamente.  \"); </script>";
      }
       echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$ProyectoContrapartida[0]\"; </script>";
      
    
      die();

}

if($opcion==3)//Eliminar ProyectoContrapartida
{
    $id = $_POST['id'];
    if($proContrapartida->eliminarProyecto($id))
      echo "<script> alert (\"Se elimino la informacion de la contrapartida correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del ProyectoContrapartida.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/ProyectoContrapartida.php\"; </script>";
die();
}

if($opcion==4)//rubros ProyectoContrapartida
{
    $id = $_GET['id'];
    if($proContrapartida->ExistenRubrosPorProyecto($id))
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$id\"; </script>";
    else
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/agregar.php?id=$id\"; </script>";
    
die();
}


?>
