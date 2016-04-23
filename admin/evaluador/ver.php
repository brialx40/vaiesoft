<?php require('header.php'); ?>
<?php

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      ////$nombres=$_SESSION['nombre'];
      ////$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/evaluador.php";
$eva=new evaluador();
$id=$_GET['id'];
$ver=$eva->buscarEvaluadorIdentificacion($id);
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Evaluador</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Evaluador</h2>
            </div>
            <div class="box-content">
                
            <form class="form-inline" role="form" method="post" action="index.php">
              <div class="form-group">
                <input name="id_evaluador" type="hidden" id="id_evaluador" value="<?php echo $ver['id_evaluador']?>"/>
                <label class="control-label" for="inputSuccess4">Identificacion:</label>
                <input type="text" class="form-control" name="identificacion" readonly id="identificacion" value="<?php echo $ver['identificacion']?>" onkeypress="return permite(event, 'num')">
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Nombres:</label>
                <input type="text" class="form-control" name="nombre" readonly id="nombre" value="<?php echo $ver['nombre']?>" onkeypress="return permite(event, 'car')">
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Apellidos:</label>
                <input type="text" class="form-control" name="apellido" readonly id="apellido" value="<?php echo $ver['apellido']?>" onkeypress="return permite(event, 'car')">
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Telefono:</label>
                <input type="text" class="form-control" name="telefono" readonly id="telefono" value="<?php echo $ver['telefono']?>" onkeypress="return permite(event, 'num')">
                <br/><br/>
                <label for="exampleInputEmail1">Email:</label>
                <input type="email" class="form-control" readonly name="email" id="email" value="<?php echo $ver['email']?>" >
                <br><br>
                <label for="exampleInputEmail1">Url cvLAC:</label>
                <input type="email" class="form-control" readonly name="email" id="email" value="<?php echo $ver['urlcvlac']?>" >
                <br><br>
                <label for="exampleInputEmail1">Disciplina(s):</label>
                <p class="form-control" style="background: #eeeeee;"><?php echo $ver['disciplinas']['nombres']?></p>
              </div><br/><br/>
              <input class="btn btn-default" type="submit" name="boton" value="Aceptar" />
                    
            </form>
            <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->



<?php require('footer.php'); ?>

