<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/Propuesta.php";
require "../../model/convocatoria.php";
require "../../model/facultad.php";
require "../../model/grupo.php";
require "../../model/Investigador.php";
require "../../model/evaluador.php";

$prop=new Propuesta();
$id=$_GET['id'];
$id_investigador = $_GET['inv'];

$ver=$prop->buscarPropuesta($id);


$conv = new convocatoria();
$facul = new facultad();
$grup = new grupo();
$inv = new Investigador();
$eva = new evaluador();

?> 
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Propuesta</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Propuesta</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php?id=<?php echo $id_investigador?>">
                
                    <label class="control-label" for="inputSuccess4">Convocatoria: </label>
                    <?php
                    $convocatoria=$conv->buscarConvocatoria($ver['convocatoria']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$convocatoria['nombre'].'</label>';                    
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Nombre: </label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['nombre']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Objetivos de la Propuesta: </label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['objetivos']?></label>                    
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Duraci&oacute;n: </label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['duracion']?></label>
                    <br/><br/>
                    <label for="fechaInicio" id="fechaInicio" >Fecha Inicio: </label>
                    <label class="control-label" type="date" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['fechaInicio']?></label>
                    <br/><br/>
                    <label for="fechafinalizacion" id="fechaFinalizacion"  >Fecha Finalizaci&oacute;n: </label>
                    <label class="control-label" type="date" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['fechaFinalizacion']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">&Aacute;rea de Conocimiento: </label>
                    <?php
                    $facultad=$facul->buscarFacultad($ver['facultad']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$facultad['nombre'].'</label>';
                    
                    ?><br/><br/>
                    <label class="control-label" for="inputSuccess4">Grupo de Investigaci&oacute;n: </label>
                    <?php
                    $grupo=$grup->buscarGrupo($ver['grupo']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$grupo['siglas'].' - '.$grupo['nombre'].'</label>';
                    ?><br/><br/>
                    <label class="control-label" for="inputSuccess4">Investigador Principal: </label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['investigador_principal']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$investigador['nombre'].'  '.$investigador['apellido'].'</label>';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana: </label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['horas_ip']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">CoInvestigador 1:</label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['coinvestigador1']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$investigador['nombre'].' '.$investigador['apellido'].'</label>';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['horas_ci1']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">CoInvestigador 2:</label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['coinvestigador2']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$investigador['nombre'].' '.$investigador['apellido'].'</label>';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['horas_ci2']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">CoInvestigador 3:</label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['coinvestigador3']);
                    echo '<label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4">'.$investigador['nombre'].' '.$investigador['apellido'].'</label>';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['horas_ci3']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">N&uacute;mero del Convenio:</label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['numero_convenio']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Nombre del Convenio:</label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['nombre_convenio']?></label>

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

