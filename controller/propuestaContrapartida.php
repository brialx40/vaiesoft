<?php

/**
 * Description of registrar
 *
 * @author Diana Calderon
 */
@session_start();
$nombres="";
$rol="";


  if ( $_SESSION['estado'] == "logeado" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
      $rol = $_SESSION['rol'];
   } else {
      echo "<script language=Javascript> location.href='../index.php'; </script>";
   }

require "../model/PropuestaContrapartida.php";
require "../model/contrapartida.php";
require "../model/Propuesta.php";

$Pro = new Propuesta();
$proContrapartida = new PropuestaContrapartida();
$cont = new contrapartida();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar PropuestaContrapartida Rubro
{

  $id_investigador = $_POST['id_investigador'];

    $PropuestaContrapartida= array();
    $PropuestaContrapartida[0]= $_POST['id_propuesta'];
    $PropuestaContrapartida[1]= $_POST['nombre'];
    $suma=0;
    $valores='';
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $valores=$valores.$i.','.$_POST[$valor].',';
           // $PropuestaContrapartida[2] =  ($i);
           // $PropuestaContrapartida[3] = $_POST[$valor];
            $suma+=$_POST[$valor];
              
          }
      }  
      $PropuestaContrapartida[2] =  $valores;
      $PropuestaContrapartida[3] = $suma; 

      if($proContrapartida->agregarPropuestaContrapartida($PropuestaContrapartida)){
        echo "<script> alert (\"Se registro la contrapartida correctamente.  \"); </script>";
        if($rol == "investigador"){
          echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/index.php?id=$PropuestaContrapartida[0]&inv=$id_investigador\"; </script>";
        }else{
          echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$PropuestaContrapartida[0]\"; </script>";
        }
        
      }    
    
      die();
}

if($opcion==2)//Editar PropuestaContrapartida
{

  $id_investigador = $_POST['id_investigador'];

    $PropuestaContrapartida= array();
    $PropuestaContrapartida[0]= $_POST['id_propuesta'];
    $PropuestaContrapartida[1]= $_POST['nombre'];
    $suma=0;
    $valores='';
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $valores=$valores.$i.','.$_POST[$valor].',';
           // $PropuestaContrapartida[2] =  ($i);
           // $PropuestaContrapartida[3] = $_POST[$valor];
            $suma+=$_POST[$valor];
              
          }
      }  
      $PropuestaContrapartida[2] =  $valores;
      $PropuestaContrapartida[3] = $suma; 
      $PropuestaContrapartida[4]= $_POST['id_pru'];

      if($proContrapartida->editarPropuestaContrapartida($PropuestaContrapartida[4], $PropuestaContrapartida)){
        echo "<script> alert (\"Se actualizo la contrapartida correctamente.  \"); </script>";
      }    
      else{
        echo "<script> alert (\"Error.. No se actualizo la contrapartida correctamente.  \"); </script>";
      }

      if($rol == "investigador"){
        echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/index.php?id=$PropuestaContrapartida[0]&inv=$id_investigador\"; </script>";
      }else{
        echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$PropuestaContrapartida[0]\"; </script>";
      }
       
      
    
      die();

}

if($opcion==3)//Eliminar PropuestaContrapartida
{
    $id = $_POST['id'];
    if($proContrapartida->eliminarPropuesta($id))
      echo "<script> alert (\"Se elimino la informacion del PropuestaContrapartida correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del PropuestaContrapartida.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/PropuestaContrapartida.php\"; </script>";
die();
}

if($opcion==4)//rubros PropuestaContrapartida
{
    $id = $_GET['id'];
    if($proContrapartida->ExistenRubrosPorPropuesta($id))
      echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$id\"; </script>";
    else
      echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/agregar.php?id=$id\"; </script>";
    
die();
}

if($opcion==5)//Agregar un Rubro al Propuesta
{
    $PropuestaContrapartida= array();
    $PropuestaContrapartida[0]= $_POST['id_propuesta'];
    $suma=0;

    $PropuestaContrapartida[1] =  $_POST['contrapartida'];
    $PropuestaContrapartida[2] = $_POST['valor'];

    $Propuesta=$Pro->buscarPropuesta($PropuestaContrapartida[0]);
    $suma= $Propuesta['presupuesto'] + $PropuestaContrapartida[2];
    
    $proContrapartida->agregarPropuestaRubro($PropuestaContrapartida);
            
    if($Pro->editarPresupuesto($PropuestaContrapartida[0], $suma)){
      echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
      echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$PropuestaContrapartida[0]\"; </script>";
    }            
         
    die();
}


?>
