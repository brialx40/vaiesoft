<?php include 'config.php' ?>
<?php

/**
 * Description of registrar
 *
 * @author Diana Calderon
 */
@session_start();
$nombres="";
$opcion=$_GET['opc'];

if($opcion!=4){
  if ( $_SESSION['estado'] == "logeado" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../index.php'; </script>";
   }
}

require "../model/Investigador.php";
require "../model/usuario.php";
require "../model/Proyecto.php";
require "../model/InvestigadorProyecto.php";
require "../model/ProyectoRubro.php";

require_once ( '../lib/class.phpmailer.php');

require_once ( '../lib/class.smtp.php');

$Inv = new Investigador();
$usu = new usuario();
$Pro = new Proyecto();
$proRubro= new ProyectoRubro();
$InvPro = new InvestigadorProyecto();



if($opcion==1)//Agregar investigador
{
    $investigador=array();
    $investigador[0]=$_POST['cedula'];
    $investigador[1]=$_POST['nombre'];
    $investigador[2]=$_POST['apellido'];
    $investigador[3]=$_POST['telefono'];
    $investigador[4]=$_POST['email'];
    $investigador[5]=$_POST['facultad'];
    $investigador[6]=$_POST['grupo'];
    
    $investi=$Inv->buscarInvestigadorPorCedula($investigador[0]);
    if($investi['nombre']==null){
      if($Inv->agregarInvestigador($investigador)){
        echo "<script> alert (\"Se registro el investigador Correctamente.\"); </script>";        
      }
      else{
        echo "<script> alert (\"No se pudo registrar el Investigador. Ya existe en el Sistema \"); </script>";        
      }
    }
    else{
      echo "<script> alert (\"No se pudo registrar el Investigador. Ya existe en el Sistema \"); </script>";      
    }
    echo "<script language=Javascript> location.href=\"../admin/investigador\"; </script>";         

    
die();
}

if($opcion==2)//Editar investigador
{
    $investigador=array();
    $investigador[0]=$_POST['cedula'];
    $investigador[1]=$_POST['nombre'];
    $investigador[2]=$_POST['apellido'];
    $investigador[3]=$_POST['telefono'];
    $investigador[4]=$_POST['email'];
    $investigador[5]=$_POST['id_investigador'];
    
    
    if($Inv->editarInvestigador($investigador[5], $investigador))
      echo "<script> alert (\"Se actualizo la informacion del investigador correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion del investigador.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/investigador\"; </script>";
die();
}

if($opcion==3)//Eliminar investigador
{
    $id = $_POST['id'];
    if($Inv->eliminarInvestigador($id))
      echo "<script> alert (\"Se elimino la informacion del investigador correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion del investigador.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/investigador\"; </script>";
die();
}

if($opcion==4)//Registrar investigador
{
    $investigador=array();
    $investigador[0]=$_POST['cedula'];
    $investigador[1]=$_POST['nombre'];
    $investigador[2]=$_POST['apellido'];
    $investigador[3]=$_POST['telefono'];
    $investigador[4]=$_POST['email'];
    $investigador[5]=$_POST['facultad'];
    $investigador[6]=$_POST['grupo'];

    $cad1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $cad2 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    $cad3 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    $usuario = array();
    $usuario[0]=$investigador[0];
    $usuario[1]=$_POST['clave'];
    $usuario[2]=$investigador[1];
    $usuario[3]=$investigador[2];
    $usuario[4]='investigador';
    $usuario[5]=$cad1.$cad2.$cad3;
    $usuario[6]= 0;

    $investi=$Inv->buscarInvestigadorPorCedula($investigador[0]);
    if($investi['nombre']==null){
      if($Inv->agregarInvestigador($investigador)){    
        if($usu->agregarUsuario($usuario)){  
        
          $msg= '<h2 align="center" style = "color:#960e0e; font-size:20px; font-weight:bolder; margin:auto;" > DATOS REGISTRADOS</h2><br><br>';
          $msg.= '<div style="padding-left:10px;margin-left:10px;"> ';
          $msg.= '<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 13px;" >';
          $msg.= 'Estimado(a) <b>'.$investigador[1].' '.$investigador[2].'</b>:<br><br>';
          $msg.= 'El Sistema VAIE le envia este mensaje para informarle sus datos de ingreso:<br><br>';
          $msg.= "<b>Usuario: </b>".$investigador[0]."<br>";
          $msg.= "<b>Contraseña: </b>".$usuario[1]."<br><br>";

          $msg.= '<b><u>Importante:</u></b> Su cuenta ha sido creada pero debe ser activada antes de usarla. ';
          $msg.= 'El siguiente link le permitir&aacute; activar su cuenta.<br><br>';
                
          $msg.= "http://".$_SERVER["SERVER_NAME"]."/SistemaVaie/activar_registro.php?cu=".$usuario[5];
          $msg.= '</p>';
          $msg.= '<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 11px;" >';
          $msg.= 'Si su cliente de correo electr&oacute;nico no permite abrir el link, por favor copielo en la barra de direcciones de su navegador web. </p>';
          $msg.='</div>';
         

          if(!enviar_mensaje($investigador[4],$investigador[1].' '.$investigador[2], 'Confirmación de Registro', $msg)) {
            echo "Error enviando: " . $mail->ErrorInfo;
          } else {
              echo "<script> alert (\"Se registro el investigador correctamente.\"); </script>";   
          }
        }                    
      }
      else{
        echo "<script> alert (\"No se pudo registrar el Investigador. Ya existe en el Sistema \"); </script>";        
      }
    }
    else{
      echo "<script> alert (\"No se pudo registrar el Investigador. Ya existe en el Sistema \"); </script>";      
    }
    echo "<script language=Javascript> location.href=\"../admin/investigador\"; </script>";         

    
die();
}

?>
