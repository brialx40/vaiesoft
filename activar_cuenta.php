<?php require('head.php'); 
   
$email = $_GET['id'];

?>
  
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
           
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" action="index.php">
                    <div style="padding-left:25px;margin-left:10px;padding-right:25px;margin-right:10px;">
                        <h2 align="center">ACTIVAR CUENTA</h2><br/>

                        Bienvenido(a):<br/><br/>
                        Su cuenta ha sido creada, pero debe ser activada antes de usarla. 
                        Se ha enviado un mensaje de activaci&oacute;n al correo  <?php echo $email;?>.

                        <br><br><br>
                        <div  align="center" >
                          <input class="btn btn-default" type="submit" name="boton" value="Aceptar" />
                        </div>
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

