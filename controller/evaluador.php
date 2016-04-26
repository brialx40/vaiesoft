<?php

/**
 * Description of registrar
 *
 * @author Diana Calderon
 */
@session_start();
$nombres = "";


if ($_SESSION['estado'] == "logeado") {
    $nombres = $_SESSION['usuario'];
    //$identificacion=$_SESSION['identificacion'];
} else {
    echo "<script language=Javascript> location.href='../index.php'; </script>";
}

require "../model/evaluador.php";
require "../model/usuario.php";

$eva = new evaluador();
$usu = new usuario();
$opcion = $_GET['opc'];

if ($opcion == 1) {//Agregar evaluador
    $evaluador = array();
    $evaluador[0] = $_POST['identificacion'];
    $evaluador[1] = $_POST['nombre'];
    $evaluador[2] = $_POST['apellido'];
    $evaluador[3] = $_POST['telefono'];
    $evaluador[4] = $_POST['email'];
    $evaluador[5] = $_POST['urlcvlac'];

    $disciplinas = $_POST['disciplinas'];

    $evaluad = $eva->buscarEvaluadorPorCedula($evaluador[0]);

    if ($evaluad['identificacion'] == 0) {
        $id = $eva->agregarEvaluador($evaluador);
        if ($id != false) {
            for ($i = 0; $i < count($disciplinas); $i++) {
                $eva->agregarDisciplinasEvaluador($id, $disciplinas[$i]);
            }

            echo "<script> alert (\"Se registro el evaluador Correctamente.\"); </script>";
        } else {
            echo "<script> alert (\"No se pudo registrar el evaluador. Ya existe en el Sistema \"); </script>";
        }
    } else {
        echo "<script> alert (\"No se pudo registrar el evaluador. Ya existe en el Sistema \"); </script>";
    }
    echo "<script language=Javascript> location.href=\"../admin/evaluador\"; </script>";


    die();
}

if ($opcion == 2) {//Editar evaluador
    $evaluador = array();
    $evaluador = array();
    $evaluador[0] = $_POST['identificacion'];
    $evaluador[1] = $_POST['nombre'];
    $evaluador[2] = $_POST['apellido'];
    $evaluador[3] = $_POST['telefono'];
    $evaluador[4] = $_POST['email'];
    $evaluador[5] = $_POST['urlcvlac'];
    $evaluador[6] = $_POST['id_evaluador'];
    
    $disciplinas = $_POST['disciplinas'];
    $viejas = $_SESSION['viejas'];

    if ($eva->editarEvaluador($evaluador[6], $evaluador,$disciplinas, $viejas))
        echo "<script> alert (\"Se actualizo la informacion del evaluador correctamente.\"); </script>";
    else
        echo "<script> alert (\"Error. No se permite actualizar la informacion del evaluador.\"); </script>";

    echo "<script language=Javascript> location.href=\"../admin/evaluador\"; </script>";
    die();
}

if ($opcion == 3) {//Eliminar evaluador
    $id = $_POST['id'];
    if ($eva->eliminarEvaluador($id))
        echo "<script> alert (\"Se elimino la informacion del evaluador correctamente.\"); </script>";
    else
        echo "<script> alert (\"Error, no se permite eliminar la informacion del evaluador.\"); </script>";

    echo "<script language=Javascript> location.href=\"../admin/evaluador\"; </script>";
    die();
}
if ($opcion == 4) {//Habilitar evaluador
    require_once '../lib/mail.php';

    $id = $_GET['id'];
    $usua = $usu->buscarUsuarioIdPersona($id);
    $evaluad = $eva->buscarEvaluadorIdentificacion($id);


    if (count($usua) != 0) {
        if ($usu->verificarUsuarioIdPersona($id, 1)) {
            $msg = '<h2 align="center" style = "color:#960e0e; font-size:20px; font-weight:bolder; margin:auto;" > DATOS REGISTRADOS</h2><br><br>';
            $msg.= '<div style="padding-left:10px;margin-left:10px;"> ';
            $msg.= '<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 13px;" >';
            $msg.= 'Estimado(a) <b>' . $evaluad['nombre'] . ' ' . $evaluad['apellido'] . '</b>:<br><br>';
            $msg.= 'El Sistema VAIE le envia este mensaje para informarle sus datos de ingreso se han habilitado:<br><br>';
            $msg.= "<b>Usuario: </b>" . $evaluad['identificacion'] . "<br>";
            $msg.= "<b>Contraseña: </b>" . $evaluad['identificacion'] . "<br><br>";
            $msg.='</div>';

            if (!enviar_mensaje($evaluad['email'], $evaluad['nombre'] . ' ' . $evaluad['apellido'], 'Habilitación Par Evaluador', $msg)) {
                echo "Error enviando: " . $mail->ErrorInfo;
            } else {
                echo "<script> alert (\"Se habilito el evaluador correctamente.\"); </script>";
            }
        } else {
            echo "<script> alert (\"Error, no se permite habilitar la informacion del evaluador.\"); </script>";
        }
    } else {
        $cad1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        $cad2 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $cad3 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);


        $usuario = array();
        $usuario[0] = $evaluad['identificacion'];
        $usuario[1] = $evaluad['identificacion'];
        $usuario[2] = $evaluad['nombre'];
        $usuario[3] = $evaluad['apellido'];
        $usuario[4] = 'evaluador';
        $usuario[5] = $cad1 . $cad2 . $cad3;
        $usuario[6] = 1;
        $usuario[7] = $id;
        if ($usu->agregarUsuarioIdPersona($usuario)) {
            $msg = '<h2 align="center" style = "color:#960e0e; font-size:20px; font-weight:bolder; margin:auto;" > DATOS REGISTRADOS</h2><br><br>';
            $msg.= '<div style="padding-left:10px;margin-left:10px;"> ';
            $msg.= '<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 13px;" >';
            $msg.= 'Estimado(a) <b>' . $evaluad['nombre'] . ' ' . $evaluad['apellido'] . '</b>:<br><br>';
            $msg.= 'El Sistema VAIE le envia este mensaje para informarle sus datos de ingreso:<br><br>';
            $msg.= "<b>Usuario: </b>" . $evaluad['identificacion'] . "<br>";
            $msg.= "<b>Contraseña: </b>" . $evaluad['identificacion'] . "<br><br>";
            $msg.='</div>';


            if (!enviar_mensaje($evaluad['email'], $evaluad['nombre'] . ' ' . $evaluad['apellido'], 'Habilitación Par Evaluador', $msg)) {
                echo "Error enviando: " . $mail->ErrorInfo;
            } else {
                echo "<script> alert (\"Se habilito el evaluador correctamente.\"); </script>";
            }
        } else {
            echo "<script> alert (\"Error, no se permite habilitar la informacion del evaluador.\"); </script>";
        }
    }
    echo "<script language=Javascript> location.href=\"../admin/evaluador\"; </script>";
    die();
}

if ($opcion == 5) {//Inhabilitar evaluador
    $id = $_GET['id'];
    $usua = $usu->buscarUsuarioIdPersona($id);

    echo $id;
    if (count($usua) != 0) {      
        if ($usu->verificarUsuarioIdPersona($id, 0)) {          
            echo "<script> alert (\"Se cambio la informacion del evaluador correctamente.\"); </script>";
        } else {
            echo "<script> alert (\"Error, no se permite inhabilitar la informacion del evaluador.\"); </script>";
        }
    } else {
        echo "<script> alert (\"Error, no se permite inhabilitar la informacion del evaluador.\"); </script>";
    }

    echo "<script language=Javascript> location.href=\"../admin/evaluador\"; </script>";
    die();
}


if ($opcion == 6) {//Agregar evaluador registrar evaluador
    $evaluador = array();
    $evaluador[0] = $_POST['identificacion'];
    $evaluador[1] = $_POST['nombre'];
    $evaluador[2] = $_POST['apellido'];
    $evaluador[3] = $_POST['telefono'];
    $evaluador[4] = $_POST['email'];
    $evaluador[5] = $_POST['urlcvlac'];

    $disciplinas = $_POST['disciplinas'];

    $evaluad = $eva->buscarEvaluadorPorCedula($evaluador[0]);

    if ($evaluad['identificacion'] == 0) {
        $id = $eva->agregarEvaluador($evaluador);
        if ($id != false) {
            for ($i = 0; $i < count($disciplinas); $i++) {
                $eva->agregarDisciplinasEvaluador($id, $disciplinas[$i]);
            }

            echo "<script> alert (\"Se registro el evaluador Correctamente.\"); </script>";
        } else {
            echo "<script> alert (\"No se pudo registrar el evaluador. Ya existe en el Sistema \"); </script>";
        }
    } else {
        echo "<script> alert (\"No se pudo registrar el evaluador. Ya existe en el Sistema \"); </script>";
    }
    echo "<script language=Javascript> location.href=\"../registrar_evaluador.php\"; </script>";


    die();
}

if ($opcion == 7) {//Editar evaluador
    $evaluador = array();
    $evaluador = array();
    $evaluador[0] = $_POST['identificacion'];
    $evaluador[1] = $_POST['nombre'];
    $evaluador[2] = $_POST['apellido'];
    $evaluador[3] = $_POST['telefono'];
    $evaluador[4] = $_POST['email'];
    $evaluador[5] = $_POST['urlcvlac'];
    $evaluador[6] = $_POST['id_evaluador'];
    
    $disciplinas = $_POST['disciplinas'];
    $viejas = $_SESSION['viejas'];

    if ($eva->editarEvaluador($evaluador[6], $evaluador, $disciplinas, $viejas))
        echo "<script> alert (\"Se actualizo la informacion del evaluador correctamente.\"); </script>";
    else
        echo "<script> alert (\"Error. No se permite actualizar la informacion del evaluador.\"); </script>";

    echo "<script language=Javascript> location.href=\"../evaluador/evaluador\"; </script>";
    die();
}

?>
