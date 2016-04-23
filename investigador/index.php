<?php require('header.php'); 

$nombres="";

  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador" ) {
      $nombres=$_SESSION['usuario'];
      
   } else {
      echo "<script language=Javascript> location.href='../index.php'; </script>";
   }
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
    </ul>
</div>
<div class="box-content alerts">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Bienvenido </strong> <?php echo $nombres?>.
  </div>
</div>

<div class="row">  
    <div class="box col-md-4" >
        <div class="box-inner homepage-box">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i>  </h2>
            </div>
            <div class="box-content">
               <form class="form-horizontal" action="index.html" method="post">
                   
                        <br/><br/>
                        
                </form>
            </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->

<?php require('footer.php'); ?>
