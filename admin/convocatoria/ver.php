<?php require('header.php'); ?>
<?php

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/convocatoria.php";
$conv=new convocatoria();
$id=$_GET['id'];
$ver=$conv->buscarConvocatoria($id);
?>    
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Convocatoria</a>
        </li>
        <li>
            <a href="#">Ver</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Convocatoria</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php">
                <div class="form-group">
                <input name="id_convocatoria" type="hidden" id="id_convocatoria" value="<?php echo $ver['id_convocatoria']?>"/>
                <label class="control-label" for="inputSuccess4">Nombre:</label>
                <input type="text" class="form-control" readonly name="nombre" id="nombre" value="<?php echo $ver['nombre']?>" >
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Año Lectivo:</label>                        
                <input type="text" class="form-control" readonly name="ano_lectivo" value="<?php echo $ver['ano_lectivo']?>" >
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Fecha Inicio:</label>
                <input name="fechaInicio" class="form-control" readonly type="date" id="fechaInicio" value="<?php echo $ver['fecha_inicio']?>" style="width:230px" />
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Fecha Fin:</label>
                <input name="fechaFin" class="form-control" readonly type="date" id="fechaFin" value="<?php echo $ver['fecha_fin']?>" style="width:230px" />
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Estado:</label>                        
                <input type="text" class="form-control" readonly name="estado" id="estado" value="<?php echo $ver['estado']?>" >
                </div>
                <br/><br/>
                <input class="btn btn-default" type="submit" name="boton" value="Aceptar" />                    
            </form>
            <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

</div><!--/row-->

<?php require('footer.php'); ?>

