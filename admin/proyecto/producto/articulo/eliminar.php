<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

$id=$_GET['id'];
?>
<script>
function funcionNo(){
    document.getElementById('form1').action="index.php";
    document.getElementById('form1').submit();
}

</script>
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
          <a href="index.php">Art&iacute;culo</a>
        </li>
        <li>
          <a href="#">Eliminar</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-trash"></i> Eliminar Art&iacute;culo</h2>
            </div>
            <div class="box-content">
                
            <form class="form-inline" role="form" method="post" id="form1" name="form1" action="../../../../controller/articulo.php?opc=3">
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php echo $id?>" />                
                <p align="center">Este registro se eliminar&aacute; permanentemente.</p>
                <p align="center">&iquest;Esta seguro que desea continuar?</p>
                <br/>
                <p align="center"><input class="btn btn-default" type="submit" name="boton" value="Eliminar" />
                <input name="cancelar" type="button" id="cancelar" style="height: 38px; width: 81px;" value="Cancelar" onclick="funcionNo()"/></p>
                    
              </div>
            </form>
            <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

</div><!--/row-->

<?php require('footer.php'); ?>

