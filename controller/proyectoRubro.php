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

require "../model/ProyectoRubro.php";
require "../model/contrapartida.php";
require "../model/Proyecto.php";

$Pro = new Proyecto();
$proRubro = new ProyectoRubro();
$cont = new contrapartida();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar proyectoRubro Rubro
{

    $proyectoRubro= array();
    $proyectoRubro[0]= $_POST['id_proyecto'];
    $suma=0;
    $cantidad=$cont->cantidadContrapartidas();
      for($i=1; $i<=$cantidad;   $i++ ){
          $valor="txtvalor".($i);
          if($_POST[$valor]!=''){
            $proyectoRubro[1] =  ($i);
            $proyectoRubro[2] = $_POST[$valor];
            $suma+=$_POST[$valor];
            $proRubro->agregarProyectoRubro($proyectoRubro);        
          }
          
          if($i==($cantidad)){
            if($Pro->editarPresupuesto($proyectoRubro[0], $suma)){
              echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
              echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$proyectoRubro[0]\"; </script>";
            }            
          }
      }     
    
      die();
}

if($opcion==2)//Editar proyectoRubro
{
    $id_pru=$_POST['id_pru'];
    $id_proyecto = $_POST['id_proyecto'];
    $valor=$_POST['valor']; 

    $rubroTemp=$proRubro->buscarProyectoRubro($id_pru);
    $valorAnt = $rubroTemp['valor'];
    $valDisAnt = $rubroTemp['valor_disponible'];

    ////////////
    $v = $valorAnt - $valor;
    $d = $valDisAnt - ($v);

    ////////////////

    $proyecto=$Pro->buscarProyecto($id_proyecto);
    $suma= $proyecto['presupuesto'] - $valorAnt + $valor; 

    if($proRubro->editarValores($id_pru, $valor, $d)){
      if($Pro->editarPresupuesto($id_proyecto, $suma)){
        echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
        echo "<script> alert (\"Se actualizo la informacion del rubro correctamente.\"); </script>";
      } 
    }      
    else{
      echo "<script> alert (\"Error. No se permite actualizar la informacion del rubro.\"); </script>";
    }      
    
echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$id_proyecto\"; </script>";
die();
}

if($opcion==3)//Eliminar proyectoRubro
{
    $id = $_POST['id'];
    if($proRubro->eliminarProyecto($id))
      echo "<script> alert (\"Se elimino la informacion del proyectoRubro correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del proyectoRubro.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/proyectoRubro.php\"; </script>";
die();
}

if($opcion==4)//rubros proyectoRubro
{
    $id = $_GET['id'];
    if($proRubro->ExistenRubrosPorProyecto($id))
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$id\"; </script>";
    else
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/agregarRub.php?id=$id\"; </script>";
    
die();
}

if($opcion==5)//Agregar un Rubro al proyecto
{
    $proyectoRubro= array();
    $proyectoRubro[0]= $_POST['id_proyecto'];
    $suma=0;

    $proyectoRubro[1] =  $_POST['contrapartida'];
    $proyectoRubro[2] = $_POST['valor'];

    $proyecto=$Pro->buscarProyecto($proyectoRubro[0]);
    $suma= $proyecto['presupuesto'] + $proyectoRubro[2];
    
    $proRubro->agregarProyectoRubro($proyectoRubro);
            
    if($Pro->editarPresupuesto($proyectoRubro[0], $suma)){
      echo "<script> alert (\"Se registro el rubro Correctamente.  $suma\"); </script>";
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$proyectoRubro[0]\"; </script>";
    }            
         
    die();
}


?>
