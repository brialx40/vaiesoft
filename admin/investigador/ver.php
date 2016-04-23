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

require "../../model/Investigador.php";
$inv=new Investigador();
$id=$_GET['id'];
$ver=$inv->buscarInvestigadorIdentificador($id);
?>    
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Investigador</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Investigador</h2>
            </div>
            <div class="box-content">
                
            <form class="form-inline" role="form" method="post" action="index.php">
              <div class="form-group">
                <input name="id_investigador" type="hidden" id="id_investigador" value="<?php echo $ver['id_investigador']?>"/>
                <label class="control-label" for="inputSuccess4">Identificacion:</label>
                <input type="text" class="form-control" name="cedula" readonly id="cedula" value="<?php echo $ver['cedula']?>" onkeypress="return permite(event, 'num')">
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
                <input type="email" class="form-control" id="exampleInputEmail1" readonly name="email" id="email" value="<?php echo $ver['email']?>" >
              </div><br/><br/>
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

