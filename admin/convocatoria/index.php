<?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/convocatoria.php";
$conv = new convocatoria();
$convocatorias=$conv->listaConvocatorias();

?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="../index.php">Inicio</a>
            </li>
            <li>
                <a href="#">Convocator&iacute;a</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-folder-open"></i> Gestionar Convocator&iacute;a</h2>
        </div>

        <div class="box-content">
        <a class="btn btn-default" href="agregar.php">
            Agregar
        </a> <br/><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>A&ntilde;o Lectivo</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php 
      
            $i=1;
            
         foreach($convocatorias as $conv): 
            echo '<tr>
                <td class="center">'.$conv['nombre'].'</td> 
                <td class="center">'.$conv['ano_lectivo'].'</td> 
                <td class="center">'.$conv['fecha_inicio'].'</td> 
                <td class="center">'.$conv['fecha_fin'].'</td>
                <td class="center">'.$conv['estado'].'</td>
                <td class="center">
        
                <a href="ver.php?id='.$conv['id_convocatoria'].'">
                   <img alt="Ver" title="Ver" src="../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$conv['id_convocatoria'].'">
                    <img alt="Editar" title="Editar" src="../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$conv['id_convocatoria'].'">
                    <img alt="Eliminar" title="Eliminar" src="../../img/eliminar.png" height="18" width="18"/>
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