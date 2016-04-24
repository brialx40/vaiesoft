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

require "../model/CalificarProyecto.php";

$calificar = new CalificarProyecto();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar calificacion
{
    $calificacionProyecto=array();
    $calificacionProyecto[0]=$_POST['id_proyecto']; ;
    for($i=0;$i<=14;$i++){
    $calificacionProyecto[]=$_POST["observaciones$i"];
    }
     
   if($calificar->){
      echo "<script> alert (\"Se registro la calificacion correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar de la calificacion. \"); </script>";
      
    }
    echo "<script language=Javascript> location.href=\"../admin/proyecto\"; </script>";         

    
die();
}

//if($opcion==2)//Editar proyecto
//{
//    $proyecto=array();
//    $proyecto[0]=$_POST['numero'];
//    $proyecto[1]=$_POST['convocatoria'];
//    $proyecto[3]=$_POST['nombre'];
//    $proyecto[4]=$_POST['grupo'];
//    $proyecto[5]=$_POST['facultad'];
//    $proyecto[6]=$_POST['fechaInicio'];
//    $anle= substr($proyecto[6], 0, 4);
//    $proyecto[2]=$anle; 
//
//    $proyecto[7]=$_POST['fechaFin'];
//    $proyecto[8]=$_POST['duracion'];
//    $proyecto[9]=$_POST['investigador_principal'];
//    $proyecto[10]=$_POST['horas_ip'];
//    $proyecto[11]=$_POST['coinvestigador1'];
//    $proyecto[12]=$_POST['horas_ci1'];
//    $proyecto[13]=$_POST['coinvestigador2'];
//    $proyecto[14]=$_POST['horas_ci2'];
//    $proyecto[15]=$_POST['coinvestigador3'];
//    $proyecto[16]=$_POST['horas_ci3'];
//    $proyecto[17]=$_POST['evaluador_propuesta'];
//    $proyecto[18]=$_POST['evaluador_final'];
//    $proyecto[19]=$_POST['observaciones'];
//    $proyecto[20]=$_POST['numero_convenio'];
//    $proyecto[21]=$_POST['nombre_convenio']; 
//    $proyecto[22]=$_POST['id_proyecto']; 
//    
//    
//    if($Pro->editarProyecto($proyecto[22], $proyecto))
//      echo "<script> alert (\"Se actualizo la informacion del proyecto correctamente.\"); </script>";
//    else
//      echo "<script> alert (\"Error. No se permite actualizar la informacion del proyecto.\"); </script>";
//    
//echo "<script language=Javascript> location.href=\"../admin/proyecto\"; </script>";
//die();
//}
//
//if($opcion==3)//Eliminar proyecto
//{
//    $id = $_POST['id'];
//    if($Pro->eliminarProyecto($id))
//      echo "<script> alert (\"Se elimino la informacion del proyecto correctamente.\"); </script>";
//    else
//      echo "<script> alert (\"Error, no se permite eliminar la informacion del proyecto.\"); </script>";
//    
//echo "<script language=Javascript> location.href=\"../admin/proyecto\"; </script>";
//die();
//}

?>
