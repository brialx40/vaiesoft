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

require "../../model/Proyecto.php";
require "../../model/convocatoria.php";
require "../../model/facultad.php";
require "../../model/grupo.php";
require "../../model/Investigador.php";
require "../../model/evaluador.php";

$proy=new Proyecto();
$id=$_GET['id'];
$editar=$proy->buscarProyecto($id);


$conv = new convocatoria();
$convocatorias=$conv->listaConvocatoriasActivas();

$facul = new facultad();
$facultad=$facul->listaFacultad();

$grup = new grupo();
$grupos=$grup->listaGrupo();

$inv = new Investigador();
$investigadores=$inv->buscarInvestigadores();

$eva = new evaluador();
$evaluadores=$eva->buscarEvaluadores();

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
                <h2><i class="glyphicon glyphicon-edit"></i> FORMATO DE EVALUACIÓN DEL INFORME(FINAL DE LOS PROYECTOS FINU)</h2>
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
                            <th>NÚMERO DEL CONTRATO:</th>
                            <th colspan="3"><?php echo $editar['numeroContrato'] ?></th>                       
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
                                    echo  $gru['siglas'];
                                endforeach;
                                ?>

                            </th>
                        </tr>
                        <tr>
                            <th>FACULTAD:</th>
                            <th>
                                <?php
                                $i = 1;
                                foreach($facultad as $fac):                                  
                                    if ($fac['id_facultad'] == $editar['facultad'] )
                                    echo  $fac['nombre'];
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
                              <textarea  class="form-control" name="observaciones1" id="observaciones1" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                       
                         <tr>
                            <td colspan="2">
                             2. ¿La metodología se ajustó a lo propuesto? 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones2" id="observaciones2" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">
                              3. ¿Se presentan con claridad y precisión los resultados obtenidos?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones3" id="observaciones3" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
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
                              <textarea  class="form-control" name="observaciones4" id="observaciones4" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                             b.	¿resolver la pregunta de investigación?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones5" id="observaciones5" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                             c.	¿aporte de nuevos conocimientos?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones6" id="observaciones6" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
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
                              <textarea  class="form-control" name="observaciones7" id="observaciones7" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              a.	¿Se discute la concordancia entre los resultados obtenidos con hallazgos previos en la literatura? 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones8" id="observaciones8" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">
                              b.	¿Se discute si hay divergencia con hallazgos previos en la literatura?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones9" id="observaciones9" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">
                             6.  ¿Las conclusiones tienen una clara fundamentación en los resultados obtenidos? 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones10" id="observaciones10" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">
                              7. ¿Se proponen posibles aplicaciones de los resultados obtenidos?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones11" id="observaciones11" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">
                              8. Teniendo en cuenta lo comprometido en la propuesta, ¿se evidencian con claridad los medios de publicación o de socialización de los resultados de investigación?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones12" id="observaciones12" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">
                              9. ¿Se evidencia la presentación o publicación de los resultados de investigación en una revista indexada u homologada por Colciencias del orden nacional o internacional?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones13" id="observaciones13" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              10. ¿Este informe es aceptable como está? Si ___   No ___ ¿Se requiere alguna modificación específica? Si ___   No ___  ¿Cuál? 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <textarea  class="form-control" name="observaciones14" id="observaciones14" size="1000" style="margin-left: 18px; width: 100%;"></textarea>
                             
                            </td>
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

