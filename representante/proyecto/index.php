<?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "representante" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }
$id = $_SESSION['id']; 

require "../../model/Proyecto.php";
$proy = new Proyecto();
$proyectos=$proy->listarProyectos();

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
                <a href="index.php">Proyecto</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-list-alt"></i> Gestionar Proyecto</h2>
        </div>

        <div class="box-content">
            <br><br>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>N&uacute;mero de Contrato</th>
            <th>A&ntilde;o</th>
            <th>Convocatoria</th>
            <th>Nombre</th>
            <th>Grupo de Investigaci&oacute;n</th>
            <th>Facultad</th>
            <th>Fecha Inicio</th>       
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;            
         foreach($proyectos as $proy): 
            echo '<tr>
                <td class="center">'.$proy['numeroContrato'].'</td>
                <td class="center">'.$proy['ano_lectivo'].'</td> ';
                $convocatoria=$con->buscarConvocatoria($proy['convocatoria']);
                echo '<td class="center">'.$convocatoria['nombre'].'</td>
                <td class="center">'.$proy['nombre'].'</td> ';

                $grupo=$gr->buscarGrupo($proy['grupo']);
                echo '<td class="center">'.$grupo['siglas'].'</td>';
                
                $facultad=$facul->buscarFacultad($proy['facultad']);
                echo '<td class="center">'.$facultad['nombre'].'</td>
                <td class="center">'.$proy['fechaInicio'].'</td>
                <td class="center">
        
                <a href="calificar.php?id='.$proy['id_proyecto'].'">
                    <img alt="calificar" title="calificar" src="../../img/calificar.gif" height="18" width="18"/>
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