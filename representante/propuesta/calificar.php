<?php require_once('header.php'); ?>
<?php
@session_start();
$nombres = "";


if ($_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "evaluador") {
    //$nombres=$_SESSION['nombre'];
    //$cedula=$_SESSION['cedula'];
} else {
    echo "<script language=Javascript> location.href='../../index.php'; </script>";
}

require_once "../../model/Propuesta.php";
require_once "../../model/convocatoria.php";
require_once "../../model/facultad.php";
require_once "../../model/grupo.php";
require_once "../../model/Investigador.php";
require_once "../../model/evaluador.php";

$prop = new Propuesta();
$id = $_GET['id'];
$editar = $prop->buscarPropuesta($id);


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

require_once "../../model/CalificarPropuesta.php";
$calificar = new CalificarPropuesta();
$conflictos = $calificar->buscarConflictosPropuesta($id);
$puntaje = $calificar->buscarPreguntasPropuestas($conflictos["id_pregunta"]);
$observaciones = $calificar->buscarObservacionesPropuestas($conflictos["id_observacion"]);

$total = 0;

function ponderar($value, $porcentaje) {
    $r = $value * $porcentaje / 100;
    $total+=$r;
    return ($r);
}
?>
<script type="text/javascript">

    function calcularPonderado(id, id_p, porcentaje) {
        var value = document.getElementById(id).value;
        value = value * porcentaje / 100;
        document.getElementById('ponderacion' + id_p).value = value;
        calcularTotal();
        return true;
    }

    function calcularTotal() {
        var suma = 0;
        var i = 1;
        while (i <= 13) {
            var id = "ponderacion" + i;
            var ponderado = document.getElementById(id).value;
            suma += parseFloat(ponderado);
            i++;
        }
        document.getElementById('total').value = suma;
        if (suma > 70) {
            var resul = document.getElementById('resultado');
            resul.style = "color: green; font-weight: bold;text-align: center;";
            resul.innerHTML = "APROBADO";
        }
        return true;
    }

    function validar(id, accion) {
        var f = document.getElementById(id);
        if (accion === 1) {//Registrar
            var i = 1;
            var res = 0;
            while (i <= 13) {
                if (document.getElementById('puntaje' + i).value !== 0) {
                    res++;
                }
                i++;
            }
            if (res === 0) {
                alert("Debe calificar al menos una pregunta");
                return false;
            }
        }
        f.opcion.value = accion;
        f.action = "../../controller/calificarPropuesta.php";
        f.submit();
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
                <h2><i class="glyphicon glyphicon-edit"></i> FORMATO DE EVALUACIÓN (PROPUESTA DE INVESTIGACIÓN GRUPOS - FINU)</h2>
            </div>
            <div class="col-md-12 alert alert-info">
                <div class="col-md-9 col-md-offset-1">
                    <p align="justify">
                        <b>INSTRUCCIONES PARA DILIGENCIAR EL FORMATO</b><br> El formato para evaluación posee la descripción de Trece (13) elementos que han sido identificados para la valoración cualitativa y cuantitativa del proyecto que usted revisa. El componente cuantitativo se valora entre el mínimo de diez [10] y un máximo de cien [100], para su
                        definición basta con asignar el valor cuantitativo en la escala numérica localizada en la columna denominada puntaje; luego, en la casilla denominada observaciones se realiza la redacción de las sugerencias o modificaciones que se deben realizar a la propuesta
                    </p>
                </div>
                <div class="col-md-2" align="rigth"><img class="img-califi" src="../../img/reporte_graficas.gif"></div>
            </div>
            <div class="box-content">
                <form class="form-inline" role="form" method="post" name="for" id="for" onSubmit="return validar(this)" enctype="multipart/form-data">

                    <table class="table responsive ">
                        <thead>
                            <tr>
                                <th>TITULO DEL PROYECTO:</th>
                                <th colspan="3"><?php echo $editar['nombre'] ?></th>                       
                            </tr>
                            <tr>
                                <th>DIRECTOR DEL PROYECTO:</th>
                                <th colspan="3">
                                    <?php
                                    $i = 1;
                                    foreach ($investigadores as $inv):
                                        if ($inv['id_investigador'] == $editar['investigador_principal']) {
                                            echo $inv['nombre'] . ' ' . $inv['apellido'];
                                        }
                                    endforeach;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th>GRUPO DE INVESTIGACIÓN:</th>
                                <th colspan="3">
                                    <?php
                                    $i = 1;
                                    foreach ($grupos as $gru):
                                        if ($gru['id_grupo'] == $editar['grupo'])
                                            echo $gru['siglas'];
                                    endforeach;
                                    ?>

                                </th>
                            </tr>

                        </thead>
                    </table>
                    <br>
                    <table  class="table table-bordered responsive ">
                        <tbody>
                            <tr>
                                <td colspan="4">
                                    <br><br>
                                    El evaluador debe notificar si tiene alguno de los siguientes tipos de conflictos de interés:
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" >
                                    a) Conflicto de interés real: cuando el evaluador(a) o su esposo(a) o algún familiar, hasta el cuarto
                                    grado de consanguinidad, o la unidad administrativa para la cual usted trabaja tiene un interés
                                    financiero, u otro tipo de interés que podrá indudablemente influenciar la posición del evaluador.
                                </td>
                                <?php
                                if ($conflictos["conflicto1"] == 1) {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto1' name='conflicto1' selected> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto1' name='conflicto1'> NO
                                    </td>
                                    <?php
                                } elseif ($conflictos["conflicto1"] == 0) {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto1' name='conflicto1'> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto1' name='conflicto1' selected> NO
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto1' name='conflicto1'> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto1' name='conflicto1'> NO
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td colspan="2" >
                                    b) Conflicto de interés aparente: cuando un interés podría no necesariamente influenciar la posición
                                    del evaluador, pero podría hacer que su objetividad fuese cuestionada por otros.
                                </td>
                                <?php
                                if ($conflictos["conflicto2"] == 1) {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto2' name='conflicto2' selected> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto2' name='conflicto2'> NO
                                    </td>
                                    <?php
                                } elseif ($conflictos["conflicto2"] == 0) {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto2' name='conflicto2'> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto2' name='conflicto2' selected> NO
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto2' name='conflicto2'> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto2' name='conflicto2'> NO
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td colspan="2" >
                                    c) Conflicto de interés potencial: cuando existe un interés del cual una persona podría
                                    razonablemente dudar, si fuese no reportado. 

                                </td>
                                <?php
                                if ($conflictos["conflicto3"] == 1) {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto3' name='conflicto3' selected> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto3' name='conflicto3'> NO
                                    </td>
                                    <?php
                                } elseif ($conflictos["conflicto3"] == 0) {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto3' name='conflicto3'> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto3' name='conflicto3' selected> NO
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <input type="radio" id='conflicto3' name='conflicto3'> SI
                                    </td>
                                    <td>
                                        <input type="radio" id='conflicto3' name='conflicto3'> NO
                                    </td>
                                <?php } ?>
                            </tr>                        
                        </tbody>
                    </table>


                    <table class="table table-bordered responsive ">
                        <thead>
                            <tr>
                                <th colspan="10" class="danger">BASE PARA LA CALIFICACIÓN DE CADA CRITERIO DE EVALUACIÓN</th>

                            </tr>
                            <tr>
                                <th colspan="4">Deficiente</th>
                                <th colspan="3">Aceptable</th>
                                <th>Bueno</th>
                                <th>Muy bueno</th>
                                <th>Excelente</th>
                            </tr>
                            <tr>
                                <th>10</th>
                                <th>20</th>
                                <th>30</th>
                                <th>40</th>
                                <th>50</th>
                                <th>60</th>
                                <th>70</th>
                                <th>80</th>
                                <th>90</th>
                                <th>100</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">CRITERIO DE EVALUACIÓN </th>
                                <th class="text-center">% DE IMPORTANCIA</th>
                                <th class="text-center">PUNTAJE</th>
                                <th class="text-center">CALIFICACIÓN<br>PONDERADA</th>
                                <th colspan="3" class="text-center">OBSERVACIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="10" class="danger">
                                    ESTRUCTURA DE LA PROPUESTA(60 ptos)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">1). Planteamiento del problema</td>
                                <td>12,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 1, 12)" max="100"  value="<?php echo $puntaje["puntaje1"]; ?>" class="input-calificacion" id="puntaje1" name="puntaje1"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje1"], 12); ?>" class="input-calificacion" id="ponderacion1" name="ponderacion1" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones1" id="observaciones1" maxlength="495"><?php echo $observaciones["obser1"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">2). Marco Teórico y Estado del Arte</td>
                                <td>10,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 2, 10)" max="100"  value="<?php echo $puntaje["puntaje2"]; ?>" class="input-calificacion" id="puntaje2" name="puntaje2"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje2"], 10); ?>" class="input-calificacion" id="ponderacion2" name="ponderacion2" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones2" id="observaciones2" maxlength="495"><?php echo $observaciones["obser2"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">3). Coherencia entre los objetivos, la metodología y los resultados</td>
                                <td>12,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 3, 12)" max="100"  value="<?php echo $puntaje["puntaje3"]; ?>" class="input-calificacion" id="puntaje3" name="puntaje3"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje3"], 12); ?>" class="input-calificacion" id="ponderacion3" name="ponderacion3" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones3" id="observaciones3" maxlength="495"><?php echo $observaciones["obser3"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">4). Idoneidad del equipo investigador para desarrollar la propuesta</td>
                                <td>5,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 4, 5)" max="100"  value="<?php echo $puntaje["puntaje4"]; ?>" class="input-calificacion" id="puntaje4" name="puntaje4"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje4"], 5); ?>" class="input-calificacion" id="ponderacion4" name="ponderacion4" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones4" id="observaciones4" maxlength="495"><?php echo $observaciones["obser4"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">5). Pertinencia de las horas solicitadas para el desarrollo de la Investigación: (Cuál es
                                    su concepto sobre el número de horas solicitadas por el Director y el/los
                                    Coinvestigador(es) para el desarrollo del proyecto, según lo establecido en el artículo 24
                                    del Acuerdo 056 de 2012)</td>
                                <td>5,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 5, 5)" max="100"  value="<?php echo $puntaje["puntaje5"]; ?>" class="input-calificacion" id="puntaje5" name="puntaje5"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje5"], 5); ?>" class="input-calificacion" id="ponderacion5" name="ponderacion5" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones5" id="observaciones5" maxlength="495"><?php echo $observaciones["obser5"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">6). Presupuesto</td>
                                <td>8,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 6, 8)" max="100"  value="<?php echo $puntaje["puntaje6"]; ?>" class="input-calificacion" id="puntaje6" name="puntaje6"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje6"], 8); ?>" class="input-calificacion" id="ponderacion6" name="ponderacion6" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones6" id="observaciones6" maxlength="495"><?php echo $observaciones["obser6"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">7). Cronograma</td>
                                <td>4,00% </td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 7, 4)" max="100"  value="<?php echo $puntaje["puntaje7"]; ?>" class="input-calificacion" id="puntaje7" name="puntaje7"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje7"], 4); ?>" class="input-calificacion" id="ponderacion7" name="ponderacion7" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones7" id="observaciones7" maxlength="495"><?php echo $observaciones["obser7"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">8). Redacción y ortografía</td>
                                <td>4,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 8, 4)" max="100"  value="<?php echo $puntaje["puntaje8"]; ?>" class="input-calificacion" id="puntaje8" name="puntaje8"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje8"], 4); ?>" class="input-calificacion" id="ponderacion8" name="ponderacion8" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones8" id="observaciones8" maxlength="495"><?php echo $observaciones["obser8"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="10" class="danger">
                                    ORIGINALIDAD E IMPACTO (40 ptos)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">9). Originalidad</td>
                                <td>10,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 9, 10)" max="100"  value="<?php echo $puntaje["puntaje9"]; ?>" class="input-calificacion" id="puntaje9" name="puntaje9"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje9"], 10); ?>" class="input-calificacion" id="ponderacion9" name="ponderacion9" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones9" id="observaciones9" maxlength="495"><?php echo $observaciones["obser9"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">10). Tamaño de la eventual población beneficiaria</td>
                                <td>10,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 10, 10)" max="100"  value="<?php echo $puntaje["puntaje10"]; ?>" class="input-calificacion" id="puntaje10" name="puntaje10"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje10"], 10); ?>" class="input-calificacion" id="ponderacion10" name="ponderacion10" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones10" id="observaciones10" maxlength="495"><?php echo $observaciones["obser10"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">11). Posibilidad de transferencia a corto plazo (menos 3 años)</td>
                                <td>6,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 11, 6)" max="100"  value="<?php echo $puntaje["puntaje11"]; ?>" class="input-calificacion" id="puntaje11" name="puntaje11"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje11"], 06); ?>" class="input-calificacion" id="ponderacion11" name="ponderacion11" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones11" id="observaciones11" maxlength="495"><?php echo $observaciones["obser11"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">12.) Posibilidad de transferencia a largo plazo (más de 3 años)</td>
                                <td>4,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 12, 4)" max="100"  value="<?php echo $puntaje["puntaje12"]; ?>" class="input-calificacion" id="puntaje12" name="puntaje12"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje12"], 04); ?>" class="input-calificacion" id="ponderacion12" name="ponderacion12" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones12" id="observaciones12" maxlength="495"><?php echo $observaciones["obser12"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">13.) Estrategias de comunicación</td>
                                <td>10,00%</td>
                                <td><input type="number" onblur="calcularPonderado(this.id, 13, 10)" max="100"  value="<?php echo $puntaje["puntaje13"]; ?>" class="input-calificacion" id="puntaje13" name="puntaje13"></td>
                                <td><input type="text" value="<?php echo ponderar($puntaje["puntaje13"], 10); ?>" class="input-calificacion" id="ponderacion13" name="ponderacion13" disabled></td>
                                <td colspan="3"><textarea  class="form-control tex-area-calif" name="observaciones13" id="observaciones13" maxlength="495"><?php echo $observaciones["obser13"]; ?></textarea></td>
                            </tr>                        
                            <tr>
                                <td colspan="4">TOTALES</td>
                                <td>100,00%</td>
                                <td></td>
                                <?php
                                if ($total < 70) {
                                    ?>
                                    <td><input type="number" max="100"  value="<?php echo $total ?>" class="input-calificacion" id="total" name="total" disabled></td>
                                    <td colspan="3"><p id="resultado" style="color: red; font-weight: bold;text-align: center;">NO APROBADO</p></td>
                                    <?php
                                } else {
                                    ?>
                                    <td><input type="number" max="100"  value="<?php echo $total ?>" class="input-calificacion" id="total" name="total" disabled></td>
                                    <td colspan="3"><p id="resultado" style="color: green; font-weight: bold;text-align: center;">APROBADO</p></td>
                                    <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" id="id_propuesta" name="id_propuesta" value="<?php echo $id ?>">
                    <input type="hidden" id="id_preguntas" name="id_preguntas" value="<?php echo $puntaje["id_pregunta"]; ?>">
                    <input type="hidden" id="id_observaciones" name="id_observaciones" value="<?php echo $observaciones["id_observacion"]; ?>">
                    <input type="hidden" name="opcion" id="opcion" value="">
                    <br/><br/>
                    <input class="btn btn-default" type="button" onclick="validar('for', 1)" name="registrar" value="Registrar"/>
                    <input class="btn btn-default" type="button" onclick="validar('for', 0)" name="calificar" value="Calificar"/>
                </form>

            </div>
        </div>
    </div>   
</div>


<?php require_once('footer.php'); ?>

