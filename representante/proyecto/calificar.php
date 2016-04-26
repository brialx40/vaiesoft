<?php require('header.php');  ?>
<?php
@session_start();
$nombres = "";


if ($_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "evaluador") {
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
require "../../model/CalificarProyecto.php";

$proy = new Proyecto();
$id = $_GET['id'];
$editar = $proy->buscarProyecto($id);


$conv = new convocatoria();
$convocatorias = $conv->listaConvocatoriasActivas();

$facul = new facultad();
$facultad = $facul->listaFacultad();

$grup = new grupo();
$grupos = $grup->listaGrupo();

$inv = new Investigador();
$investigadores = $inv->buscarInvestigadores();

$eva = new evaluador();
$evaluadores = $eva->buscarEvaluadores();

$cal = new CalificarProyecto();
$calificacion = $cal->listarCalificacionProyecto($id);

if(count($calificacion)<=0){
    for($i=1;$i<=14;$i++){
    $calificacion[]="";
    }
}
 ?>
<script type="text/javascript">
    function registrar() {

        condicion = true;
        var resp = 0;
        for (var i = 1; i <= 14; i++) {
            if (document.getElementById('observaciones' + i).value !== "") {
                resp++;
            }
        }
        if (resp === 0) {
            alert("Mínimo debe existir una calificación para continuar el registro.");
            return false;
        } else {
            document.getElementById("for").action = "../../controller/calificarProyecto.php?opc=1";
            document.getElementById("for").submit();
        }
    }

    function calificar() {

        condicion = true;

        for (var i = 1; i <= 14; i++) {

            if (document.getElementById('observaciones' + i).value === "") {
                alert("Debe llenar todas los campos para poder realizar la calificación.");
                return;
            } else {
                document.getElementById("for").action = "../../controller/calificarProyecto.php?opc=2";
                document.getElementById("for").submit();
            }
        }

        return true;

    }



</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Propuesta</a>
        </li>
        <li>
            <a href="#">Calificar</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> FORMATO DE EVALUACIÓN DEL INFORME(FINAL DE LOS PROYECTOS FINU)</h2>
            </div>

            <div class="box-content">
                <form class="form-inline" role="form" method="post" name="for" id="for" action="">
                    <input name="id_proyecto" type="hidden" id="id_proyecto" value="<?php echo $editar['id_proyecto'];  ?>"/>
                    <table class="table responsive ">
                        <thead>
                            <tr>
                                <th>TITULO DEL PROYECTO:</th>
                                <th colspan="3"><?php echo $editar['nombre'];  ?></th>                       
                            </tr>
                            <tr>
                                <th>NÚMERO DEL CONTRATO:</th>
                                <th colspan="3"><?php echo $editar['numeroContrato'];  ?></th>                       
                            </tr>
                            <tr>
                                <th>DIRECTOR DEL PROYECTO:</th>
                                <th>
                                    <?php
                                    $i = 1;
                                    foreach ($investigadores as $inv):

                                        if ($inv['id_investigador'] == $editar['investigador_principal'])
                                            echo $inv['nombre'] . ' ' . $inv['apellido'];

                                    endforeach;
                                     ?>
                                </th>
                            </tr>
                            <tr>
                                <th>GRUPO DE INVESTIGACIÓN:</th>
                                <th>
                                    <?php
                                    $i = 1;
                                    foreach ($grupos as $gru):
                                        if ($gru['id_grupo'] == $editar['grupo'])
                                            echo $gru['siglas'];
                                    endforeach;
                                     ?>

                                </th>
                            </tr>
                            <tr>
                                <th>FACULTAD:</th>
                                <th>
                                    <?php
                                    $i = 1;
                                    foreach ($facultad as $fac):
                                        if ($fac['id_facultad'] == $editar['facultad'])
                                            echo $fac['nombre'];
                                    endforeach;
                                     ?>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    1.	¿En qué medida se lograron los objetivos propuestos de la investigación? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones1" id="observaciones1" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[1];  ?></textarea>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    2. ¿La metodología se ajustó a lo propuesto? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones2" id="observaciones2" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[2];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    3. ¿Se presentan con claridad y precisión los resultados obtenidos?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones3" id="observaciones3" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[3];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    4. Los resultados contribuyen a:  
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    a.	¿la solución del problema planteado? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones4" id="observaciones4" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[4];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    b.	¿resolver la pregunta de investigación?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones5" id="observaciones5" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[5];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    c.	¿aporte de nuevos conocimientos?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones6" id="observaciones6" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[6];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    5. En la discusión: 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    a.	¿Se discute la concordancia entre los resultados obtenidos con hallazgos previos en la literatura? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones7" id="observaciones7" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[7];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    a.	¿Se discute la concordancia entre los resultados obtenidos con hallazgos previos en la literatura? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones8" id="observaciones8" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[8];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    b.	¿Se discute si hay divergencia con hallazgos previos en la literatura?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones9" id="observaciones9" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[9];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    6.  ¿Las conclusiones tienen una clara fundamentación en los resultados obtenidos? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones10" id="observaciones10" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[10];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    7. ¿Se proponen posibles aplicaciones de los resultados obtenidos?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones11" id="observaciones11" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[11];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    8. Teniendo en cuenta lo comprometido en la propuesta, ¿se evidencian con claridad los medios de publicación o de socialización de los resultados de investigación?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones12" id="observaciones12" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[12];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    9. ¿Se evidencia la presentación o publicación de los resultados de investigación en una revista indexada u homologada por Colciencias del orden nacional o internacional?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones13" id="observaciones13" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[13];  ?></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    10. ¿Este informe es aceptable como está? Si ___   No ___ ¿Se requiere alguna modificación específica? Si ___   No ___  ¿Cuál? 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea  class="form-control" name="observaciones14" id="observaciones14" size="1000"  maxlength="995" style="margin-left: 18px; width: 100%;"><?php echo $calificacion[14];  ?></textarea>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br/><br/><input class="btn btn-default" id="registrar" name="registrar" type="button" name="boton" value="Registrar" onclick="registrar()" />
                    <input class="btn btn-default" id="calificar" name="calificar" type="button" name="boton" value="Calificar"  onclick="calificar()"/>
                </form>

            </div>
        </div>
    </div>   
</div>


<?php require('footer.php');  ?>

