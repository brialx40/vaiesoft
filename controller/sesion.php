<?php

/**
 * Description of sesion
 *
 * @author Diana Calderon
 */
@session_start();


require "../model/usuario.php";
require "../model/Investigador.php";
require "../model/evaluador.php";

include ("../lib/mail.php");

$usu = new usuario();
$inv = new Investigador();
$eva =  new evaluador();


$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

if ($usu->iniciarSesion($usuario, $clave)) {
    $i = $usu->buscarSesion($usuario, $clave);
    $investigador = $inv->buscarInvestigadorPorCedula($usuario);
    $evaluador = $eva->buscarEvaluadorPorCedula($usuario);
    $email = $investigador['email'];

    if ($i[0]['verificado'] == '1') {

        $_SESSION['estado'] = "logeado";
        $_SESSION['usuario'] = $i[0]['nombre'] . " " . $i[0]['apellido'];
        $_SESSION['rol'] = $i[0]['rol'];
        if(count($investigador)>0){
        $_SESSION['id'] = $investigador['id_investigador'];
        }
        if(count($evaluador)>0){
        $_SESSION['id'] = $evaluador['id_evaluador'];  
       
        }

        echo "<script language=Javascript> location.href=\"../" . $i[0]['rol'] . "/index.php\"; </script>";
    } else {
        if($i[0]['rol']!= "evaluador"){
        $msg = '<h2 align="center" style = "color:#960e0e; font-size:20px; font-weight:bolder; margin:auto;" > DATOS REGISTRADOS</h2><br><br>';
        $msg.= '<div style="padding-left:10px;margin-left:10px;"> ';
        $msg.= '<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 13px;" >';
        $msg.= 'Estimado(a) <b>' . $i[0]['nombre'] . " " . $i[0]['apellido'] . '</b>:<br><br>';
        $msg.= 'El Sistema VAIE le envia este mensaje para informarle sus datos de ingreso:<br><br>';
        $msg.= "<b>Usuario: </b>" . $i[0]['login'] . "<br>";
        $msg.= "<b>Contraseña: </b>" . $i[0]['clave'] . "<br><br>";

        $msg.= '<b><u>Importante:</u></b> Su cuenta ha sido creada pero debe ser activada antes de usarla. ';
        $msg.= 'El siguiente link le permitir&aacute; activar su cuenta.<br><br>';

        $msg.= "http://" . $_SERVER["SERVER_NAME"] . "/SistemaVaie/activar_registro.php?cu=" . $i[0]['codigo_verificacion'];
        $msg.= '</p>';
        $msg.= '<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 11px;" >';
        $msg.= 'Si su cliente de correo electr&oacute;nico no permite abrir el link, por favor copielo en la barra de direcciones de su navegador web. </p>';
        $msg.='</div>';

        enviar_mensaje($email, $i[0]['nombre'] . " " . $i[0]['apellido'], 'Activación de Cuenta', $msg);
        echo "<script language=Javascript> location.href=\"../activar_cuenta.php?id=$email&rol=investigador\"; </script>";
        } else{
         echo "<script language=Javascript> location.href=\"../activar_cuenta.php?id=$email&rol=evaluador\"; </script>";
          
        }
    }
} else {
    echo "<script> alert (\"No ha podido Iniciar Sesión.\"); </script>";
    echo "<script language=Javascript> location.href=\"../index.php\"; </script>";
}

die();
?>
