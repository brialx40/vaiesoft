<?php require('head.php'); 

require "model/usuario.php";
    
$cu=$_GET['cu'];
$usu = new usuario();

if($cu==null){
  echo "<script language=Javascript> location.href='index.php'; </script>"; 
}
else{
  $usuario=$usu->buscarUsuario($cu);
 
  if ( $usuario['id_usuario']!= '' ) {
      if($usu->verificado($usuario['id_usuario'])){
      }
   } else {
      echo "<script language=Javascript> location.href='index.php'; </script>";
   }

}


?>
  
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
           
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" action="index.php">
                    <div style="padding-left:25px;margin-left:10px;padding-right:25px;margin-right:10px;">
                        <h2 align="center">ACTIVAR CUENTA</h2><br/>

                        Bienvenido(a):<br/><br/>
                        Gracias por registrarse en el Sistema........

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

