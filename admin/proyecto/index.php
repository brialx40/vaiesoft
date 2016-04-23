<?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

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
        <a class="btn btn-default" href="agregar.php">
            Agregar
        </a> <br/><br/>
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
        
                <a href="ver.php?id='.$proy['id_proyecto'].'">
                   <img alt="Ver" title="Ver" src="../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$proy['id_proyecto'].'">
                    <img alt="Editar" title="Editar" src="../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$proy['id_proyecto'].'">
                    <img alt="Eliminar" title="Eliminar" src="../../img/eliminar.png" height="18" width="18"/>
                </a>
                 <a href="../../controller/proyectoRubro.php?opc=4&id='.$proy['id_proyecto'].'">
                    <img alt="Rubros" title="Rubros" src="../../img/rubro.jpg" height="19" width="19"/>
                </a>
                <a href="producto/index.php?id='.$proy['id_proyecto'].'">
                    <img alt="Productos" title="Productos" src="../../img/producto.jpg" height="19" width="16"/>
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