<?php require('header.php'); ?>
<?php
@session_start();
$nombres = "";


if ($_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "evaluador") {
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
?>
<script type="text/javascript">
    function validar(f) {

        condicion = true;

        if (!f.upload.value && !f.pdf.value) {
            alert('Por favor adjunte el archivo de la propuesta en formato pdf');
            f.upload.focus();
            condicion = false;
            return false;
        }

        if (f.upload.value) {

            var ext = f.upload.value.substring(f.upload.value.lastIndexOf(".")).toLowerCase();
            if (ext !== ".pdf") {
                alert('El archivo adjunto de la propuesta solo se permite en formato pdf');
                f.upload.value = '';
                f.upload.focus();
                condicion = false;
                return false;
            }
            var fileSize = f.upload.files[0].size;

            if (fileSize > (1024 * 1024 * 5)) {
                alert('El archivo adjunto de la propuesta no puede superar 3Mb');
                f.upload.value = '';
                f.upload.focus();
                condicion = false;
                return false;
            }
        }

        if (f.convocatoria.value == '0') {
            alert('Por favor seleccione una Convocatoria');
            f.convocatoria.focus();
            condicion = false;
            return false;
        }

        if (f.nombre.value == '') {
            alert('Por favor llene el campo Nombre');
            f.nombre.focus();
            condicion = false;
            return false;
        }

        if (f.objetivos.value == '') {
            alert('Por favor digite los objetivos de la propuesta');
            f.objetivos.focus();
            condicion = false;
            return false;
        }

        if (f.duracion.value == '0') {
            alert('Por favor seleccione la duracion del Propuesta');
            f.duracion.focus();
            condicion = false;
            return false;
        }

        if (f.facultad.value == '0') {
            alert('Por favor seleccione un Area del Conocimiento');
            f.facultad.focus();
            condicion = false;
            return false;
        }

        if (f.grupo.value == '0') {
            alert('Por favor seleccione un Grupo de Investigacion');
            f.grupo.focus();
            condicion = false;
            return false;
        }

        if (f.investigador_principal.value == '0') {
            alert('Por favor seleccione un Investigador Principal');
            f.investigador_principal.focus();
            condicion = false;
            return false;
        }

        if (f.horas_ip.value == '') {
            alert('Por favor llene el campo Dedicacion Horas/Semana');
            f.horas_ip.focus();
            condicion = false;
            return false;
        }

        return true;

    }

    function permite(elEvento, permitidos) {
        // Variables que definen los caracteres permitidos
        var numeros = "0123456789";
        var caracteres = " @abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ_-";
        var numeros_caracteres = numeros + caracteres;
        var teclas_especiales = [8, 37, 39, 46];
        // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha


        // Seleccionar los caracteres a partir del parámetro de la función
        switch (permitidos) {
            case 'num':
                permitidos = numeros;
                break;
            case 'car':
                permitidos = caracteres;
                break;
            case 'num_car':
                permitidos = numeros_caracteres;
                break;
        }

        // Obtener la tecla pulsada 
        var evento = elEvento || window.event;
        var codigoCaracter = evento.charCode || evento.keyCode;
        var caracter = String.fromCharCode(codigoCaracter);

        // Comprobar si la tecla pulsada es alguna de las teclas especiales
        // (teclas de borrado y flechas horizontales)
        var tecla_especial = false;
        for (var i in teclas_especiales) {
            if (codigoCaracter == teclas_especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
        // o si es una tecla especial
        return permitidos.indexOf(caracter) != -1 || tecla_especial;
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
               <div class="alert alert-info" role="alert">
                   <p align="justify">
                       <b>INSTRUCCIONES PARA DILIGENCIAR EL FORMATO</b> El formato para evaluación posee la descripción de Trece (13) elementos que han sido identificados para la valoración cualitativa y cuantitativa del proyecto que usted revisa. El componente cuantitativo se valora entre el mínimo de diez [10] y un máximo de cien [100], para su
                    definición basta con asignar el valor cuantitativo en la escala numérica localizada en la columna denominada puntaje; luego, en la casilla denominada observaciones se realiza la redacción de las sugerencias o modificaciones que se deben realizar a la propuesta
                    </p>
               </div>
            <div class="box-content">
                <form class="form-inline" role="form" method="post" name="for" id="for" action="../../controller/propuesta.php?opc=2" onSubmit="return validar(this)" enctype="multipart/form-data">
                  
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
                                
                                if ($inv['id_investigador'] == $editar['investigador_principal']) 
                                  
                                echo $inv['nombre'] . ' ' . $inv['apellido'];

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
                                    echo  $gru['siglas'];
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
                            <td>
                                <input type="radio" id='conflicto1' name='conflicto1'> SI
                            </td>
                            <td>
                                <input type="radio" id='conflicto1' name='conflicto1'> NO
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" >
                            b) Conflicto de interés aparente: cuando un interés podría no necesariamente influenciar la posición
                            del evaluador, pero podría hacer que su objetividad fuese cuestionada por otros.
                            </td>
                            <td>
                                <input type="radio" id='conflicto2' name='conflicto1'> SI
                            </td>
                            <td>
                                <input type="radio" id='conflicto2' name='conflicto1'> NO
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2" >
                            c) Conflicto de interés potencial: cuando existe un interés del cual una persona podría
                            razonablemente dudar, si fuese no reportado. 

                            </td>
                            <td>
                                <input type="radio" id='conflicto3' name='conflicto1'> SI
                            </td>
                            <td>
                                <input type="radio" id='conflicto3' name='conflicto1'> NO
                            </td>
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
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje1" name="puntaje1"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion1" name="ponderacion1" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones1" id="observaciones1" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">2). Marco Teórico y Estado del Arte</td>
                            <td>10,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje2" name="puntaje2"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion2" name="ponderacion2" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones2" id="observaciones2" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">3). Coherencia entre los objetivos, la metodología y los resultados</td>
                            <td>12,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje3" name="puntaje3"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion3" name="ponderacion3" readonly></td>
                            <td colspan="3"><textarea  class="form-control" name="observaciones3" id="observaciones3" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">4). Idoneidad del equipo investigador para desarrollar la propuesta</td>
                            <td>5,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje4" name="puntaje4"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion4" name="ponderacion4" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones4" id="observaciones4" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">5). Pertinencia de las horas solicitadas para el desarrollo de la Investigación: (Cuál es
                            su concepto sobre el número de horas solicitadas por el Director y el/los
                            Coinvestigador(es) para el desarrollo del proyecto, según lo establecido en el artículo 24
                            del Acuerdo 056 de 2012)</td>
                            <td>5,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje5" name="puntaje5"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion5" name="ponderacion5" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones5" id="observaciones5" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">6). Presupuesto</td>
                            <td>8,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje6" name="puntaje6"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion6" name="ponderacion6" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones6" id="observaciones6" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">7). Cronograma</td>
                            <td>4,00% </td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje7" name="puntaje7"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion7" name="ponderacion7" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones7" id="observaciones7" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="4">8). Redacción y ortografía</td>
                            <td>4,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje8" name="puntaje8"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion8" name="ponderacion8" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones8" id="observaciones8" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                        <tr>
                            <td colspan="10" class="danger">
                                ORIGINALIDAD E IMPACTO (40 ptos)
                            </td>
                        </tr>
                         <tr>
                            <td colspan="4">9). Originalidad</td>
                            <td>10,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje2" name="puntaje2"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion2" name="ponderacion2" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones9" id="observaciones9" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr>
                         <tr>
                            <td colspan="4">10). Tamaño de la eventual población beneficiaria</td>
                            <td>10,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje2" name="puntaje2"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion2" name="ponderacion2" readonly></td>
                             <td colspan="3"><textarea  class="form-control" name="observaciones10" id="observaciones10" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                            
                        </tr> <tr>
                            <td colspan="4">11). Posibilidad de transferencia a corto plazo (menos 3 años)</td>
                            <td>6,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje2" name="puntaje2"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion2" name="ponderacion2" readonly></td>
                            <td colspan="3"><textarea  class="form-control" name="observaciones11" id="observaciones11" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                        </tr>
                         <tr>
                            <td colspan="4">12.) Posibilidad de transferencia a largo plazo (más de 3 años)</td>
                            <td>4,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje2" name="puntaje2"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion2" name="ponderacion2" readonly></td>
                            <td colspan="3"><textarea  class="form-control" name="observaciones12" id="observaciones12" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                        </tr>
                         <tr>
                            <td colspan="4">13.) Estrategias de comunicación</td>
                            <td>10,00%</td>
                            <td><input type="number" maxlength="100" value="0,0" id="puntaje2" name="puntaje2"></td>
                            <td><input type="number" maxlength="100" value="0,0" id="ponderacion2" name="ponderacion2" readonly></td>
                            <td colspan="3"><textarea  class="form-control" name="observaciones13" id="observaciones13" size="1000" style="margin-left: 18px; width: 300px; height: 200px;"></textarea></td>
                            
                        </tr>
                        <tr>
                            <td colspan="4">TOTALES</td>
                            <td>100,00%</td>
                            <td></td>
                            <td><input type="number" maxlength="100" value="0,0" id="total" name="total" readonly></td>
                            <td colspan="3"><input type="text" value="NO APROBADO" id="aprobado" name="aprovado" readonly></td>
                            
                        </tr>
                    </tbody>
                </table>
                    <br/><br/><input class="btn btn-default" type="submit" name="boton" value="Actualizar"  />
                    <input class="btn btn-default" type="submit" name="boton" value="Actualizar"  />
            </form>
              
            </div>
        </div>
    </div>   
</div>


<?php require('footer.php'); ?>

