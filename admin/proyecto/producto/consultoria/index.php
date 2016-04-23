                                                                                                                                                                                            <?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

require "../../../../model/consultoria.php";
$con = new consultoria();
$id=$_GET['id'];

$consultorias=$con->listarConsultoriaProyecto($id);

?>
    <div>
        <ul class="breadcrumb">
            <li>
              <a href="../../../index.php">Inicio</a>
            </li>
            <li>
              <a href="../../index.php">Proyecto</a>
            </li>
            <li>
              <a href="../index.php">Productos</a>
            </li>
            <li>
              <a href="index.php">Consultor&iacute;a Cient&iacute;fico-Tecnol&oacute;gica</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-user"></i> Gestionar Consultor&iacute;a Cient&iacute;fico-Tecnol&oacute;gica</h2>
        </div>

        <div class="box-content">
        <a class="btn btn-default" href="agregar.php?id=<?php echo $id?>">
            Agregar
        </a> <br/><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>T&iacute;tulo</th>
            <th style="width:250px;">N&uacute;mero de Registro</th>
            <th>A&ntilde;o</th>
            <th style="width:125px;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;            
         foreach($consultorias as $con): 
            echo '<tr>
                <td class="center">'.$con['titulo'].'</td>
                <td class="center">'.$con['numero_registro'].'</td>
                <td class="center">'.$con['ano_lectivo'].'</td>
                <td class="center">
        
                <a href="ver.php?id='.$con['id_software'].'">
                   <img alt="Ver" title="Ver" src="../../../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$con['id_software'].'">
                    <img alt="Editar" title="Editar" src="../../../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$con['id_software'].'">
                    <img alt="Eliminar" title="Eliminar" src="../../../../img/eliminar.png" height="18" width="18"/>
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