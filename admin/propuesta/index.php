<?php require('header.php'); 
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
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
        <a class="btn btn-default" href="agregar.php">
            Agregar
        </a> <br/><br/>
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
        
                <a href="ver.php?id='.$prop['id_propuesta'].'">
                   <img alt="Ver" title="Ver" src="../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$prop['id_propuesta'].'">
                    <img alt="Editar" title="Editar" src="../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$prop['id_propuesta'].'">
                    <img alt="Eliminar" title="Eliminar" src="../../img/eliminar.png" height="18" width="18"/>
                </a>
                <a href="../../controller/propuestaRubro.php?opc=4&id='.$prop['id_propuesta'].'">
                    <img alt="Rubros" title="Rubros" src="../../img/rubro.jpg" height="19" width="19"/>
                </a>
                <a href="../../controller/propuesta.php?opc=4&id='.$prop['id_propuesta'].'&e='.$prop['estado'].'">
                    <img alt="Aprobar" title="Aprobar" src="../../img/aprobado.jpg" height="17" width="17"/>
                </a>
                <a href="../../controller/propuesta.php?opc=6&id='.$prop['id_propuesta'].'&e='.$prop['estado'].'">
                    <img alt="Desaprobar" title="Desaprobar" src="../../img/desaprobado.jpg" height="17" width="17"/>
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