<?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/evaluador.php";
require "../../model/usuario.php";
$eva = new evaluador();
$evaluadores=$eva->buscarEvaluadores();

$usu = new usuario();
?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="../index.php">Inicio</a>
            </li>
            <li>
                <a href="index.php">Evaluador</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-user"></i> Gestionar Evaluador</h2>
        </div>

        <div class="box-content">
        <a class="btn btn-default" href="agregar.php">
            Agregar
        </a> <br/><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>Identificaci&oacute;n</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Tel&eacute;fono</th>
            <th>Email</th>
            <th>Estado Usuario</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php 
      
            $i=1;
            
         foreach($evaluadores as $eva): 
            $usuario = $usu->verificadoUsuarioIdPersona($eva['id_evaluador']);
            echo '<tr>
                <td class="center">'.$eva['identificacion'].'</td> 
                <td class="center">'.$eva['nombre'].'</td> 
                <td class="center">'.$eva['apellido'].'</td> 
                <td class="center">'.$eva['telefono'].'</td>
                <td class="center">'.$eva['email'].'</td>';
                if(!$usuario){
                  echo '<td class="center">Inhabilitado</td>'; 
                }else{
                  echo '<td class="center">Habilitado</td>';   
                }
                echo '<td class="center">
        
                <a href="ver.php?id='.$eva['id_evaluador'].'">
                   <img alt="Ver" title="Ver" src="../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$eva['id_evaluador'].'">
                    <img alt="Editar" title="Editar" src="../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$eva['id_evaluador'].'">
                    <img alt="Eliminar" title="Eliminar" src="../../img/eliminar.png" height="18" width="18"/>
                </a>';
            if(!$usuario){
                echo '<a href="../../controller/evaluador.php?opc=4&id='.$eva['id_evaluador'].'">
                    <img alt="Habilitar" title="Habilitar" src="../../img/aprobado.jpg" height="17" width="17"/>
                </a>';
            }else{
                echo '<a href="../../controller/evaluador.php?opc=5&id='.$eva['id_evaluador'].'">
                    <img alt="Deshabilitar" title="Deshabilitar" src="../../img/desaprobado.jpg" height="17" width="17"/>
                </a>';
            }
                echo '</td>
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