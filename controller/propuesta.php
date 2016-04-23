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

require "../model/Propuesta.php";
require "../model/Proyecto.php";
require "../model/ProyectoRubro.php";
require "../model/movimientoRubro.php";

$Pro = new Propuesta();
$Proy = new Proyecto();
$proRubro = new ProyectoRubro();
$movRubro = new movimientoRubro();

$opcion=$_GET['opc'];

if($opcion==1)//Agregar propuesta
{
    $propuesta=array();
    $propuesta[0]=$_POST['convocatoria'];
    $propuesta[2]=$_POST['nombre'];
    $propuesta[3]=$_POST['objetivos'];
    $propuesta[4]=$_POST['grupo'];
    $propuesta[5]=$_POST['facultad'];
    $propuesta[6]=$_POST['fechaInicio'];
    $anle= substr($propuesta[6], 0, 4);
    $propuesta[1]=$anle;  

    $propuesta[7]=$_POST['fechaFin'];
    $propuesta[8]=$_POST['duracion'];
    $propuesta[9]=$_POST['investigador_principal'];
    $propuesta[10]=$_POST['horas_ip'];
    $propuesta[11]=$_POST['coinvestigador1'];
    $propuesta[12]=$_POST['horas_ci1'];
    $propuesta[13]=$_POST['coinvestigador2'];
    $propuesta[14]=$_POST['horas_ci2'];
    $propuesta[15]=$_POST['coinvestigador3'];
    $propuesta[16]=$_POST['horas_ci3'];
    $propuesta[17]=$_POST['evaluador_propuesta'];
    $propuesta[18]=$_POST['observaciones'];
    $propuesta[19]=$_POST['numero_convenio'];
    $propuesta[20]=$_POST['nombre_convenio']; 
    $propuesta[21]= 'PENDIENTE';
    $propuesta[22]= 0;

    $id=$_POST['id_investigador'];
    
   if($Pro->agregarPropuesta($propuesta)){
      echo "<script> alert (\"Se registro la propuesta correctamente.\"); </script>";
      
    }
    else{
      echo "<script> alert (\"No se pudo registrar la propuesta. Ya existe en el Sistema. \"); </script>";
      
    }
    if($rol == "admin"){
        echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";         
    }
    else{
        echo "<script language=Javascript> location.href=\"../".$rol."/propuesta/index.php?id=".$id."\"; </script>";         
    }
    
    
die();
}

if($opcion==2)//Editar propuesta Admin
{
    $propuesta=array();
    $propuesta[0]=$_POST['convocatoria'];
    $propuesta[2]=$_POST['nombre'];
    $propuesta[3]=$_POST['objetivos'];
    $propuesta[4]=$_POST['grupo'];
    $propuesta[5]=$_POST['facultad'];
    $propuesta[6]=$_POST['fechaInicio'];
    $anle= substr($propuesta[6], 0, 4);
    $propuesta[1]=$anle;  

    $propuesta[7]=$_POST['fechaFin'];
    $propuesta[8]=$_POST['duracion'];
    $propuesta[9]=$_POST['investigador_principal'];
    $propuesta[10]=$_POST['horas_ip'];
    $propuesta[11]=$_POST['coinvestigador1'];
    $propuesta[12]=$_POST['horas_ci1'];
    $propuesta[13]=$_POST['coinvestigador2'];
    $propuesta[14]=$_POST['horas_ci2'];
    $propuesta[15]=$_POST['coinvestigador3'];
    $propuesta[16]=$_POST['horas_ci3'];
    $propuesta[17]=$_POST['evaluador_propuesta'];
    $propuesta[18]=$_POST['observaciones'];
    $propuesta[19]=$_POST['numero_convenio'];
    $propuesta[20]=$_POST['nombre_convenio']; 
    $propuesta[21]=$_POST['id_propuesta']; 
    
    
    if($Pro->editarPropuesta($propuesta[21], $propuesta))
      echo "<script> alert (\"Se actualizo la informacion de la propuesta correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion de la propuesta.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";
die();
}

if($opcion==3)//Eliminar propuesta
{
    $id = $_POST['id'];
    if($Pro->eliminarPropuesta($id))
      echo "<script> alert (\"Se elimino la informacion de la propuesta correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error, no se permite eliminar la informacion de la propuesta.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";
die();
}

if($opcion==4)//Aprobada propuesta
{
    $id_propuesta = $_GET['id'];
    $estado=$_GET['e'];

    if($estado=='APROBADA'){
        echo "<script> alert (\"La propuesta ya ha sido Aprobada.\"); </script>";
        echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";
    }
    else if(($estado=='PENDIENTE') || ($estado=='DESAPROBADA')){
        echo "<script language=Javascript> location.href=\"../admin/propuesta/aprobada.php?id=$id_propuesta\"; </script>";
    }

die();
} 

if($opcion==5)//Agregar propuesta aprobada
{
    $id_propuesta=$_POST['id_propuesta'];
    
    $proyecto=array();
    $proyecto[0]=$id_propuesta;
    $proyecto[1]=$_POST['numero'];
    $proyecto[2]=$_POST['convocatoria'];
    $proyecto[4]=$_POST['nombre'];
    $proyecto[5]=$_POST['grupo'];
    $proyecto[6]=$_POST['facultad'];
    $proyecto[7]=$_POST['fechaInicio'];
    $anle= substr($proyecto[7], 0, 4);
    $proyecto[3]=$anle; 

    $proyecto[8]=$_POST['fechaFin'];
    $proyecto[9]=$_POST['duracion'];
    $proyecto[10]=0;
    $proyecto[11]=0 ;
    $proyecto[12]=$_POST['investigador_principal'];
    $proyecto[13]=$_POST['horas_ip'];
    $proyecto[14]=$_POST['coinvestigador1'];
    $proyecto[15]=$_POST['horas_ci1'];
    $proyecto[16]=$_POST['coinvestigador2'];
    $proyecto[17]=$_POST['horas_ci2'];
    $proyecto[18]=$_POST['coinvestigador3'];
    $proyecto[19]=$_POST['horas_ci3'];
    $proyecto[20]=$_POST['evaluador_propuesta'];
    $proyecto[21]=$_POST['evaluador_final'];
    $proyecto[22]=$_POST['observaciones'];
    $proyecto[23]=$_POST['numero_convenio'];
    $proyecto[24]=$_POST['nombre_convenio']; 
    $proyecto[25]= 'ACTIVO';

    
   if($Proy->agregarProyecto($proyecto)){
        if($Pro->editarEstado($id_propuesta, 'APROBADA')){
            echo "<script> alert (\"Se registro el proyecto correctamente.\"); </script>";
        }     
   }
   else{
     echo "<script> alert (\"No se pudo registrar el proyecto. Ya existe en el Sistema. \"); </script>";      
   }
    echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";         
    
die();
}

if($opcion==6)//Desaprobada propuesta
{
    $id_propuesta = $_GET['id'];
    $estado=$_GET['e'];

    if($estado=='DESAPROBADA'){
        echo "<script> alert (\"La propuesta ya ha sido Desaprobada.\"); </script>";
        echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";
    }
    else if($estado=='PENDIENTE'){
        if($Pro->editarEstado($id_propuesta, 'DESAPROBADA')){
            echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";
        }  
    }
    else if($estado=='APROBADA'){
        $proyecto=$Proy->buscarProyectoPorPropuesta($id_propuesta);
        if($Proy->eliminarProyecto($proyecto['id_proyecto'])){
            if($proRubro->eliminarProyectoRubroPorProyecto($proyecto['id_proyecto']));
            if($movRubro->eliminarMovimientoRubroPorProyecto($proyecto['id_proyecto']));
            if($Pro->editarEstado($id_propuesta, 'DESAPROBADA')){
                echo "<script language=Javascript> location.href=\"../admin/propuesta\"; </script>";
            }      
        }
   }
die();
} 

if($opcion==7)//Editar propuesta investigador
{
    $propuesta=array();
    $propuesta[0]=$_POST['convocatoria'];
    $propuesta[2]=$_POST['nombre'];
    $propuesta[3]=$_POST['objetivos'];
    $propuesta[4]=$_POST['grupo'];
    $propuesta[5]=$_POST['facultad'];
    $propuesta[6]=$_POST['fechaInicio'];
    $anle= substr($propuesta[6], 0, 4);
    $propuesta[1]=$anle;  

    $propuesta[7]=$_POST['fechaFin'];
    $propuesta[8]=$_POST['duracion'];
    $propuesta[9]=$_POST['investigador_principal'];
    $propuesta[10]=$_POST['horas_ip'];
    $propuesta[11]=$_POST['coinvestigador1'];
    $propuesta[12]=$_POST['horas_ci1'];
    $propuesta[13]=$_POST['coinvestigador2'];
    $propuesta[14]=$_POST['horas_ci2'];
    $propuesta[15]=$_POST['coinvestigador3'];
    $propuesta[16]=$_POST['horas_ci3'];
    $propuesta[17]=$_POST['numero_convenio'];
    $propuesta[18]=$_POST['nombre_convenio']; 
    $propuesta[19]=$_POST['id_propuesta']; 
    
    $id=$_POST['id_investigador'];
    
    if($Pro->editarPropuesta2($propuesta[19], $propuesta))
      echo "<script> alert (\"Se actualizo la informacion de la propuesta correctamente.\"); </script>";
    else
      echo "<script> alert (\"Error. No se permite actualizar la informacion de la propuesta.\"); </script>";
    
echo "<script language=Javascript> location.href=\"../".$rol."/propuesta/index.php?id=".$id."\"; </script>";
die();
}


?>
