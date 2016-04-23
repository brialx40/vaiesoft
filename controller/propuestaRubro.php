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

require "../model/PropuestaRubro.php";
require "../model/contrapartida.php";
require "../model/Propuesta.php";

$Pro = new Propuesta();
$proRubro = new PropuestaRubro();
$cont = new contrapartida();

$opcion=$_GET['opc'];

if($rol == "admin"){

if($opcion==1)//Agregar PropuestaRubro Rubro
{

    $PropuestaRubro= array();
    $PropuestaRubro[0]= $_POST['id_propuesta'];
    $suma=0;
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $PropuestaRubro[1] =  ($i);
            $PropuestaRubro[2] = $_POST[$valor];
            $suma+=$_POST[$valor];
            $proRubro->agregarPropuestaRubro($PropuestaRubro);        
          }
          
          if($i==($cantidad)){
            if($Pro->editarPresupuesto($PropuestaRubro[0], $suma)){
              echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
              echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$PropuestaRubro[0]\"; </script>";
            }            
          }
      }     
    
      die();
}

if($opcion==2)//Editar PropuestaRubro
{
    $id_pru=$_POST['id_pru'];
    $id_propuesta = $_POST['id_propuesta'];
    $valor=$_POST['valor']; 

    $rubroTemp=$proRubro->buscarPropuestaRubro($id_pru);
    $valorAnt = $rubroTemp['valor'];
    
    ////////////
    $v = $valorAnt - $valor;
    
    ////////////////

    $Propuesta=$Pro->buscarPropuesta($id_propuesta);
    $suma= $Propuesta['presupuesto'] - $valorAnt + $valor; 

    if($proRubro->editarValor($id_pru, $valor)){
      if($Pro->editarPresupuesto($id_propuesta, $suma)){
        echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
        echo "<script> alert (\"Se actualizo la informacion del rubro correctamente.\"); </script>";
      } 
    }      
    else{
      echo "<script> alert (\"Error. No se permite actualizar la informacion del rubro.\"); </script>";
    }      
    
echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$id_propuesta\"; </script>";
die();
}

if($opcion==3)//Eliminar PropuestaRubro
{
    $id = $_POST['id'];
    if($proRubro->eliminarPropuesta($id))
      echo "<script> alert (\"Se elimino la informacion del PropuestaRubro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del PropuestaRubro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/PropuestaRubro.php\"; </script>";
die();
}

if($opcion==4)//rubros PropuestaRubro
{
    $id = $_GET['id'];
    if($proRubro->ExistenRubrosPorPropuesta($id))
      echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$id\"; </script>";
    else
      echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/agregar.php?id=$id\"; </script>";
    
die();
}

if($opcion==5)//Agregar un Rubro al Propuesta
{
    $PropuestaRubro= array();
    $PropuestaRubro[0]= $_POST['id_propuesta'];
    $suma=0;

    $PropuestaRubro[1] =  $_POST['contrapartida'];
    $PropuestaRubro[2] = $_POST['valor'];

    $Propuesta=$Pro->buscarPropuesta($PropuestaRubro[0]);
    $suma= $Propuesta['presupuesto'] + $PropuestaRubro[2];
    
    $proRubro->agregarPropuestaRubro($PropuestaRubro);
            
    if($Pro->editarPresupuesto($PropuestaRubro[0], $suma)){
      echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
      echo "<script language=Javascript> location.href=\"../admin/propuesta/rubros/index.php?id=$PropuestaRubro[0]\"; </script>";
    }            
         
    die();
}
}

if($rol == "investigador"){

    $id_investigador =$_GET['inv'];
  
if($opcion==1)//Agregar PropuestaRubro Rubro
{

  $id_investigador =$_POST['id_investigador'];

    $PropuestaRubro= array();
    $PropuestaRubro[0]= $_POST['id_propuesta'];
    $suma=0;
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $PropuestaRubro[1] =  ($i);
            $PropuestaRubro[2] = $_POST[$valor];
            $suma+=$_POST[$valor];
            $proRubro->agregarPropuestaRubro($PropuestaRubro);        
          }
          
          if($i==($cantidad)){
            if($Pro->editarPresupuesto($PropuestaRubro[0], $suma)){
              echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
              echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/index.php?id=$PropuestaRubro[0]&inv=$id_investigador\"; </script>";
            }            
          }
      }     
    
      die();
}

if($opcion==2)//Editar PropuestaRubro
{
  $id_investigador =$_POST['id_investigador'];

    $id_pru=$_POST['id_pru'];
    $id_propuesta = $_POST['id_propuesta'];
    $valor=$_POST['valor']; 

    $rubroTemp=$proRubro->buscarPropuestaRubro($id_pru);
    $valorAnt = $rubroTemp['valor'];
    
    ////////////
    $v = $valorAnt - $valor;
    
    ////////////////

    $Propuesta=$Pro->buscarPropuesta($id_propuesta);
    $suma= $Propuesta['presupuesto'] - $valorAnt + $valor; 

    if($proRubro->editarValor($id_pru, $valor)){
      if($Pro->editarPresupuesto($id_propuesta, $suma)){
        echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
        echo "<script> alert (\"Se actualizo la informacion del rubro correctamente.\"); </script>";
      } 
    }      
    else{
      echo "<script> alert (\"Error. No se permite actualizar la informacion del rubro.\"); </script>";
    }      
    
echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/index.php?id=$id_propuesta&inv=$id_investigador\"; </script>";
die();
}

if($opcion==3)//Eliminar PropuestaRubro
{
    $id = $_POST['id'];
    if($proRubro->eliminarPropuesta($id))
      echo "<script> alert (\"Se elimino la informacion del PropuestaRubro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del PropuestaRubro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/PropuestaRubro.php\"; </script>";
die();
}

if($opcion==4)//rubros PropuestaRubro
{
    $id = $_GET['id'];
    if($proRubro->ExistenRubrosPorPropuesta($id))
      echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/index.php?id=$id&inv=$id_investigador\"; </script>";
    else
      echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/agregar.php?id=$id&inv=$id_investigador\"; </script>";
    
die();
}

if($opcion==5)//Agregar un Rubro al Propuesta
{
    $PropuestaRubro= array();
    $PropuestaRubro[0]= $_POST['id_propuesta'];
    $suma=0;

    $PropuestaRubro[1] =  $_POST['contrapartida'];
    $PropuestaRubro[2] = $_POST['valor'];

    $Propuesta=$Pro->buscarPropuesta($PropuestaRubro[0]);
    $suma= $Propuesta['presupuesto'] + $PropuestaRubro[2];
    
    $proRubro->agregarPropuestaRubro($PropuestaRubro);
            
    if($Pro->editarPresupuesto($PropuestaRubro[0], $suma)){
      echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
      echo "<script language=Javascript> location.href=\"../investigador/propuesta/rubros/index.php?id=$PropuestaRubro[0]&inv=$id_investigador\"; </script>";
    }            
         
    die();
}
}
?>
