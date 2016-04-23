<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/Proyecto.php";
require "../../model/convocatoria.php";
require "../../model/facultad.php";
require "../../model/grupo.php";
require "../../model/Investigador.php";
require "../../model/evaluador.php";

$Pro=new Proyecto();
$id=$_GET['id'];
$ver=$Pro->buscarProyecto($id);

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
            <a href="index.php">Proyecto</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Proyecto</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess4">Convocatoria: </label>
                    <?php
                    $convocatoria=$conv->buscarConvocatoria($ver['convocatoria']);
                    echo '<input type="text" class="form-control" readonly value="'.$convocatoria['nombre'].'" >';                    
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Nombre: </label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['nombre']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Objetivos de la Proyecto: </label>
                    <br/><textarea  class="form-control" readonly size="1000" style="margin-left: 18px; width: 500px; height: 200px;"><?php echo $ver['objetivos']?></textarea>                        
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Duracion: </label>
                    <input type="text" class="form-control" readonly  value="<?php echo $ver['duracion']?>" >
                    <br/><br/>
                    <label for="fechaInicio" id="fechaInicio" >Fecha Inicio: </label>
                    <input name="fechaInicio" class="form-control" type="date" readonly value="<?php echo $ver['fechaInicio']?>" style="width:230px" />
                     <br/><br/>
                    <label for="fechafinalizacion" id="fechaFinalizacion"  >Fecha Finalizacion: </label>
                    <input name="fechaFin" class="form-control" type="date" readonly value="<?php echo $ver['fechaFinalizacion']?>"  style="width:230px" />
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Area de Conocimiento: </label>
                    <?php
                    $facultad=$facul->buscarFacultad($ver['facultad']);
                    echo '<input type="text" class="form-control" readonly value="'.$facultad['nombre'].'" >';
                    
                    ?><br/><br/>
                    <label class="control-label" for="inputSuccess4">Grupo de Investigacion: </label>
                    <?php
                    $grupo=$grup->buscarGrupo($ver['grupo']);
                    echo '<input type="text" class="form-control" readonly value="'.$grupo['siglas'].'" >';
                    ?><br/><br/>
                    <label class="control-label" for="inputSuccess4">Investigador Principal: </label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['investigador_principal']);
                    echo '<input type="text" class="form-control" readonly value="'.$investigador['nombre'].'  '.$investigador['apellido'].'" >';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicacion Horas/Semana: </label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['horas_ip']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">CoInvestigador 1:</label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['coinvestigador1']);
                    echo '<input type="text" class="form-control" readonly value="'.$investigador['nombre'].' '.$investigador['apellido'].'" >';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicacion Horas/Semana:</label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['horas_ci1']?>" >
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">CoInvestigador 2:</label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['coinvestigador2']);
                    echo '<input type="text" class="form-control" readonly value="'.$investigador['nombre'].' '.$investigador['apellido'].'" >';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicacion Horas/Semana:</label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['horas_ci2']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">CoInvestigador 3:</label>
                    <?php
                    $investigador=$inv->buscarInvestigadorIdentificador($ver['coinvestigador3']);
                    echo '<input type="text" class="form-control" readonly value="'.$investigador['nombre'].' '.$investigador['apellido'].'" >';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Dedicacion Horas/Semana:</label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['horas_ci3']?>" >
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Numero del Convenio:</label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['numero_convenio']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Nombre del Convenio:</label>
                    <input type="text" class="form-control" readonly value="<?php echo $ver['nombre_convenio']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Evaluador de la Propuesta:</label>
                    <?php
                    $evaluador=$eva->buscarEvaluadorIdentificacion($ver['evaluador_propuesta']);
                    echo '<input type="text" class="form-control" readonly value="'.$evaluador['nombre'].' '.$evaluador['apellido'].'" >';
                    ?>                        
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Evaluador del Proyecto:</label>
                    <?php
                    $evaluador=$eva->buscarEvaluadorIdentificacion($ver['evaluador_final']);
                    echo '<input type="text" class="form-control" readonly value="'.$evaluador['nombre'].' '.$evaluador['apellido'].'" >';
                    ?> <br/><br/>
                    <label class="control-label" for="inputSuccess4">Observaciones del Proyecto:</label>
                    <br/><textarea  class="form-control" readonly size="1000" style="margin-left: 18px; width: 500px; height: 200px;"><?php echo $ver['observaciones']?></textarea>                        
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

