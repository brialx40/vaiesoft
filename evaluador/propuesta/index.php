<?php require('header.php'); 
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "evaluador" ) {
      $nombres=$_SESSION['usuario'];
      ////$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/Propuesta.php";
$prop = new Propuesta();
$propuestas=$prop->listarPropuesta();

require "../../model/convocatoria.php";
$con = new convocatoria();

require "../../model/grupo.php";
$gr = new grupo();

require "../../model/facultad.php";
$facul = new facultad();


?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="../index.php">Inicio</a>
            </li>
            <li>
                <a href="index.php">Propuesta</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-book"></i> Gestionar Propuesta</h2>
        </div>

        <div class="box-content">
        <br/><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>Convocatoria</th>
            <th>A&ntilde;o</th>
            <th>Nombre</th>
            <th>Grupo de Investigaci&oacute;n</th>
            <th>Facultad</th>
            <th>Fecha Inicio</th>  
            <th>Estado</th>     
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;            
         foreach($propuestas as $prop): 
            echo '<tr>';
                $convocatoria=$con->buscarConvocatoria($prop['convocatoria']);
                echo '<td class="center">'.$convocatoria['nombre'].'</td>
                <td class="center">'.$prop['ano_lectivo'].'</td>
                <td class="center">'.$prop['nombre'].'</td> ';

                $grupo=$gr->buscarGrupo($prop['grupo']);
                echo '<td class="center">'.$grupo['siglas'].'</td>';
                
                $facultad=$facul->buscarFacultad($prop['facultad']);
                echo '<td class="center">'.$facultad['nombre'].'</td>
                <td class="center">'.$prop['fechaInicio'].'</td>
                <td class="center">'.$prop['estado'].'</td>
                <td class="center">
        
                <a href="calificar.php?id='.$prop['id_propuesta'].'">
                    <img alt="Calificar" title="Calificar" src="../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="../../controller/propuesta.php?opc=8&id='.$prop['id_propuesta'].'&e='.$prop['estado'].'">
                    <img alt="Descargar" title="Descargar" src="../../img/descargar.png" height="17" width="17"/>
                </a>
                </td>
            </tr>';
        
            $i=$i+1;
        endforeach;
            
      ?>
       
        </tbody>
        </table>
        </div>
        </div>
        </div>
    
    </div><!--/row-->

<?php require('footer.php'); ?>