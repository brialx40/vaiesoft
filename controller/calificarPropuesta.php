<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

@session_start();
$nombres = "";


if ($_SESSION['estado'] == "logeado") {
    $nombres = $_SESSION['usuario'];
    //$identificacion=$_SESSION['identificacion'];
} else {
    echo "<script language=Javascript> location.href='../index.php'; </script>";
}

$id = $_POST["id_propuesta"];

if (isset($_POST['opcion'])) {
    $opcion = $_POST['opcion'];
} else {
    $opcion = "";
}
//---- Capturo variables de conflicto ----//
$criterios = array();
$criterios[] = 0;
//Capturo los criterios del evaluador
for ($i = 1; $i <= 3; $i++) {
    if (isset($_POST["conflicto$i"])) {
        $puntaje = $_POST["conflicto$i"];
    } else {
        $puntaje = 2;//si no hay seleccionados
    }
    $criterios[] = $puntaje;
}
//---- Capturo variables de preguntas ----//
$respuestas = array();
//Valido si ya se habiá registrado las preguntas
if (isset($_POST["id_preguntas"])&&$_POST["id_preguntas"] != "") {
    $respuestas[] = $_POST["id_preguntas"];
} else {
    $respuestas[] = 0;//si hay registro de preguntas
}
//Capturo los valores de los puntajes
for ($i = 1; $i <= 13; $i++) {
    if (isset($_POST["puntaje$i"])) {
        $puntaje = $_POST["puntaje$i"];
    } else {
        $puntaje = 0;
    }
    $respuestas[] = $puntaje;
}
//---- Capturo variables de observaciones ----//
$observaciones = array();
//Valido si habia registro de observaciones
if (isset($_POST["id_observaciones"])&& $_POST["id_observaciones"] != "") {
    $observaciones[] = $_POST["id_observaciones"];    
} else {
    $observaciones[] = 0;//si no hay registros
}
//Capturo las observaciones digitas por el evaluador
for ($i = 1; $i <= 13; $i++) {
    if (isset($_POST["observaciones$i"])) {
        $puntaje = $_POST["observaciones$i"];
    }
    if ($puntaje == "") {
        $puntaje = "-";
    }
    $observaciones[] = $puntaje;
}

require_once '../model/CalificarPropuesta.php';

$calificar = new CalificarPropuesta();

if ($opcion == 0) {//calificar
    
} elseif ($opcion == 1) {//registrar    
    if($respuestas[0] == 0){//primera vez
        if($calificar->agregarCalificacionPropuesta($id, $criterios, $respuestas, $observaciones)){
            echo "<script> alert (\"Se registro la calificación Correctamente.\"); </script>";
        }else{
            echo "<script> alert (\"No se registro la calificacion.\"); </script>";
        }
    }else{//n vez
       if($calificar->editarCalificacionPropuesta($id, $criterios, $respuestas, $observaciones)){
            echo "<script> alert (\"Se actualizo la calificación Correctamente.\"); </script>";
        }else{
            echo "<script> alert (\"No se actualizo la calificacion.\"); </script>";
        } 
    }
    echo "<script language=Javascript> location.href=\"../evaluador/propuesta\"; </script>";
    die();
}
