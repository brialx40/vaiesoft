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

require "../model/movimientoRubro.php";
require "../model/contrapartida.php";
require "../model/Proyecto.php";
require "../model/ProyectoRubro.php";

$Pro = new Proyecto();
$proRubro = new ProyectoRubro();
$cont = new contrapartida();
$mov = new movimientoRubro();

$opcion=$_GET['opc'];

if($opcion==1)//Retiro Rubro
{
    $movimientoRubro= array();
    $movimientoRubro[0]= $_POST['id_proyecto'];
    $movimientoRubro[1]= $_POST['id_pru'];
    $movimientoRubro[2]= $_POST['valor_solicitado'];
    $movimientoRubro[3]= 0;
    $movimientoRubro[4]= $_POST['fecha'];
    $movimientoRubro[5]= $_POST['observacion'];
    $movimientoRubro[6]= $_POST['numero_orden'];
    $valor_disponible = $_POST['valor']-$_POST['valor_solicitado'];

    if($mov->agregarMovimiento($movimientoRubro)){
      if($proRubro->editarValorDisponible($movimientoRubro[1], $valor_disponible)){
        echo "<script> alert (\"Se registro la ejecuci&oacute;n del proyecto correctamente.\"); </script>";
      }     
    }
    else{
      echo "<script> alert (\"No se pudo registrar el retiro.  \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$movimientoRubro[0]\"; </script>";               

die();
}

if($opcion==2)//Movimiento Rubro
{
    $movimientoRubro= array();
    $movimientoRubro[0]= $_POST['id_proyecto'];
    $movimientoRubro[1]= $_POST['id_pru'];
    $movimientoRubro[2]= $_POST['valor_solicitado'];
    $movimientoRubro[3]= $_POST['rubro_destino'];
    $movimientoRubro[4]= $_POST['fecha'];
    $movimientoRubro[5]= $_POST['observacion'];
    $movimientoRubro[6]= $_POST['numero_orden'];
    $movimientoRubro[7]= $_POST['valor_solicitado'];
    $valor1_rubroOrigen = $_POST['valor']-$movimientoRubro[7];
    $valor2_rubroOrigen = $_POST['valor_disponible']-$movimientoRubro[7];

    $rubro_destino = $proRubro->buscarProyectoRubro($movimientoRubro[3]);
    $valor1_rubroDestino = $rubro_destino['valor']+$movimientoRubro[7];
    $valor2_rubroDestino = $rubro_destino['valor_disponible']+$movimientoRubro[7];

    if($mov->agregarMovimiento($movimientoRubro)){
      if($proRubro->editarValores($movimientoRubro[1], $valor1_rubroOrigen, $valor2_rubroOrigen)){
        if($proRubro->editarValores($movimientoRubro[3], $valor1_rubroDestino, $valor2_rubroDestino)){
          echo "<script> alert (\"Se registro el cambio de rubro correctamente.\"); </script>";
        } 
      }     
    }
    else{
      echo "<script> alert (\"No se pudo registrar el retiro.  \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$movimientoRubro[0]\"; </script>";               

die();
}

if($opcion==3)
{
    $id_pru = $_GET['id_pru'];
    $id_proyecto = $_GET['id'];
    $proyecto = $Pro->buscarProyecto($id_proyecto);
    $total = $proyecto['presupuesto'] * 10 /100;
    $movimientos=$mov->listaMovimientosPorProyecto($id_proyecto);
    $i=1;
    $valor=0;
    foreach($movimientos as $movi): 
      $valor+=$movi['valor_solicitado'];        
      $i=$i+1;
    endforeach;
    $cntMov = 0;

    if($total>$valor){
      $cntMov = $total-$valor;
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/movimiento.php?id=$id_pru&cant_mov=$cntMov\"; </script>";
    }
    else{
      echo "<script> alert (\"No se puede realizar movimientos.\"); </script>";
      echo "<script language=Javascript> location.href=\"../admin/proyecto/rubros/index.php?id=$id_proyecto\"; </script>";
    }
      
die();
}



?>
