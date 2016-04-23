<?php
require('header.php');

@session_start();
$nombres = "";


if ($_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "evaluador") {
    $nombres = $_SESSION['usuario'];
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


<div class="row">  
    <div class="box col-md-12" >
        <div class="box-inner homepage-box">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i>  </h2>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 panel panel-default">
                    <div class="col-md-2 col-sm-2 col-xs-12 col-lg-2">
                        <img class="img-form" src="../img/evaluador.gif">
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12 col-lg-8">
                        <br><br><br>
                        <label>Bienvenido <?php echo $nombres ?>. </label>
                    </div>                                 
                </div>
           </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->

<?php require('footer.php'); ?>
