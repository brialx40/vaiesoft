<?php require('header.php');

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   } 

require "../../model/convocatoria.php";
require "../../model/facultad.php";
require "../../model/grupo.php";
require "../../model/Investigador.php";
require "../../model/evaluador.php";
require "../../model/Propuesta.php";

$prop=new Propuesta();
$id=$_GET['id'];
$propuesta=$prop->buscarPropuesta($id);

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
        function validar() {
             
            condicion=true;
            numero = document.getElementById("numero").value;
            convocatoria = document.getElementById("convocatoria").value;
            nombre = document.getElementById("nombre").value;
            duracion = document.getElementById("duracion").value;
            facultad = document.getElementById("facultad").value;
            grupo = document.getElementById("grupo").value;
            investigador_principal = document.getElementById("investigador_principal").value;
            horas_ip = document.getElementById("horas_ip").value;
            evaluador_propuesta = document.getElementById("evaluador_propuesta").value;
            
            if(numero == ''){
                alert('Por favor llene el campo Numero de Contrato');
                document.getElementById("numero").focus();
                condicion=false;
                return false;
            }

            if(convocatoria == '0'){
                alert('Por favor seleccione una Convocatoria');
                document.getElementById("convocatoria").focus();
                condicion=false;
                return false;
            }

            if(nombre == ''){
                alert('Por favor llene el campo Nombre');
                document.getElementById("nombre").focus();
                condicion=false;
                return false;
            }

            if(duracion == '0'){
                alert('Por favor seleccione la duracion del proyecto');
                document.getElementById("duracion").focus();
                condicion=false;
                return false;
            }

            if(facultad == '0'){
                alert('Por favor seleccione un área del conocimiento');
                document.getElementById("facultad").focus();
                condicion=false;
                return false;
            }

            if(grupo == '0'){
                alert('Por favor seleccione un Grupo de Investigación');
                document.getElementById("grupo").focus();
                condicion=false;
                return false;
            }

            if(investigador_principal == '0'){
                alert('Por favor seleccione un Investigador Principal');
                document.getElementById("investigador_principal").focus();
                condicion=false;
                return false;
            }

            if(horas_ip == ''){
                alert('Por favor llene el campo Dedicación Horas/Semana');
                document.getElementById("horas_ip").focus();
                condicion=false;
                return false;
            }
                        
            if( condicion!=false ) {    
                document.getElementById("for").action="../../controller/propuesta.php?opc=5";
                document.getElementById("for").submit();  
     
              }
        }

         function permite(elEvento, permitidos) {
                      // Variables que definen los caracteres permitidos
              var numeros = "0123456789";
              var caracteres = " @abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ_-";
              var numeros_caracteres = numeros + caracteres;
              var teclas_especiales = [8, 37, 39, 46];
              // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha

              // Seleccionar los caracteres a partir del parámetro de la función
              switch(permitidos) {
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
              for(var i in teclas_especiales) {
                if(codigoCaracter == teclas_especiales[i]) {
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
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Agregar Proyecto</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="for" id="for">
                    <div class="form-group">
                        <br/>
                             <input name="id_propuesta" type="hidden" id="id_propuesta" value="<?php echo $id?>"/>
                              <label class="control-label" for="inputSuccess4">Número de Contrato:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input type="text" class="form-control" name="numero" id="numero">
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">Convocatoria:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="convocatoria" id="convocatoria" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                              <?php       
                                $i=1;
                              foreach($convocatorias as $con):
                                  echo '<option ';
                                  if ($con['id_convocatoria'] == $propuesta['convocatoria'] ){
                                    echo ' selected ';
                                  }
                                  echo ' value="'.$con['id_convocatoria'].'">'.$con['nombre'].'</option>';
                                      
                                  $i=$i+1;
                              endforeach;                                
                            ?>
                            </select><br/><br/>
                              <label class="control-label" for="inputSuccess4">Nombre:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $propuesta['nombre']?>" >
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">Duraci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="duracion" id="duracion" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                                <option <?phpif ($propuesta['duracion'] == '1 Semestre'){?> selected <?php}?> value="1 Semestre">1 Semestre</option>
                                <option <?phpif ($propuesta['duracion'] == '2 Semestres'){?> selected <?php}?> value="2 Semestres">2 Semestres</option>
                                <option <?phpif ($propuesta['duracion'] == '3 Semestres'){?> selected <?php}?> value="3 Semestres">3 Semestres</option>
                                <option <?phpif ($propuesta['duracion'] == '4 Semestres'){?> selected <?php}?> value="4 Semestres">4 Semestres</option>
                              </select> <br/><br/>
                              <label for="fechaInicio" id="fechaInicio" >Fecha Inicio:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input name="fechaInicio" class="form-control" type="date" id="fechaInicio" value="<?php echo $propuesta['fechaInicio']?>" style="width:230px" />
                              <br/><br/>
                              <label for="fechafinalizacion" id="fechaFinalizacion"  >Fecha Finalizaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input name="fechaFin" class="form-control" type="date" id="fechaFin" value="<?php echo $propuesta['fechaFinalizacion']?>"  style="width:230px" />
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">&Aacute;rea de Conocimiento:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="facultad" id="facultad" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                              <?php       
                                $i=1;                                
                               foreach($facultad as $fac): 
                                  echo '<option ';
                                  if ($fac['id_facultad'] == $propuesta['facultad'] ){
                                    echo ' selected ';
                                  }
                                  echo ' value="'.$fac['id_facultad'].'">'.$fac['nombre'].'</option>';
                                      
                                  $i=$i+1;
                                endforeach;                        
                              ?>
                              </select> 
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">Grupo de Investigaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="grupo" id="grupo" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                              <?php       
                                $i=1;   
                                foreach($grupos as $gru): 
                                  echo '<option ';
                                  if ($gru['id_grupo'] == $propuesta['grupo'] ){
                                    echo ' selected ';
                                  }
                                  echo ' value="'.$gru['id_grupo'].'">'.$gru['siglas'].'</option>';
                                      
                                  $i=$i+1;
                                endforeach;                              
                              ?>
                              </select>
                              <br/><br/>
                        <label class="control-label" for="inputSuccess4">Investigador Principal:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <select name="investigador_principal" id="investigador_principal" data-rel="chosen" >
                          <option value="0">Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option ';
                            if ($inv['id_investigador'] == $propuesta['investigador_principal'] ){
                              echo ' selected ';
                            }
                             echo ' value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                      
                              $i=$i+1;
                          endforeach;                               
                        ?>
                        </select> <br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="horas_ip" id="horas_ip" value="<?php echo $propuesta['horas_ip']?>">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">CoInvestigador 1:</label>
                        <select name="coinvestigador1" id="coinvestigador1" data-rel="chosen" >
                          <option value="0"> Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option ';
                            if ($inv['id_investigador'] == $propuesta['coinvestigador1'] ){
                              echo ' selected ';
                            }
                             echo ' value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                      
                              $i=$i+1;
                          endforeach;                                
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                        <input type="text" class="form-control" name="horas_ci1" value="<?php echo $propuesta['horas_ci1']?>" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">CoInvestigador 2:</label>
                        <select name="coinvestigador2" id="coinvestigador2" data-rel="chosen" >
                          <option value="0">Seleccione </option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option ';
                            if ($inv['id_investigador'] == $propuesta['coinvestigador2'] ){
                              echo ' selected ';
                            }
                             echo ' value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                      
                              $i=$i+1;
                          endforeach;                                
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                        <input type="text" class="form-control" name="horas_ci2" value="<?php echo $propuesta['horas_ci2']?>">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">CoInvestigador 3:</label>
                        <select name="coinvestigador3" id="coinvestigador3" data-rel="chosen" >
                          <option value="0"> Seleccione</option>
                        <?php       
                         $i=1;
                           foreach($investigadores as $inv): 
                            echo '<option ';
                            if ($inv['id_investigador'] == $propuesta['coinvestigador3'] ){
                              echo ' selected ';
                            }
                             echo ' value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                      
                              $i=$i+1;
                          endforeach;                                  
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                        <input type="text" class="form-control" name="horas_ci3" value="<?php echo $propuesta['horas_ci3']?>" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">N&uacute;mero del Convenio:</label>
                        <input type="text" class="form-control" name="numero_convenio" value="<?php echo $propuesta['numero_convenio']?>">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Nombre del Convenio:</label>
                        <input type="text" class="form-control" name="nombre_convenio" value="<?php echo $propuesta['nombre_convenio']?>">                        
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Evaluador de la Propuesta:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <select name="evaluador_propuesta" id="evaluador_propuesta" data-rel="chosen" >
                          <option value="0">Seleccione</option>
                        <?php       
                         $i=1;  
                           foreach($evaluadores as $eva):
                            echo '<option ';
                            if ($eva['id_evaluador'] == $propuesta['evaluador_propuesta'] ){
                              echo ' selected ';
                            }
                             echo ' value="'.$eva['id_evaluador'].'">'.$eva['nombre'].' '.$eva['apellido'].'</option>';
                                      
                              $i=$i+1;
                          endforeach;                                 
                        ?>
                        </select> <br/><br/>
                        <label class="control-label" for="inputSuccess4">Evaluador del Informe Final:</label>
                        <select name="evaluador_final" id="evaluador_final" data-rel="chosen" >
                          <option value="0"> Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($evaluadores as $eva): 
                            echo '<option value="'.$eva['id_evaluador'].'">'.$eva['nombre'].' '.$eva['apellido'].'</option>';
                                    
                            $i=$i+1;
                          endforeach;                               
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Observaciones del Proyecto:</label>
                        <br/><textarea  class="form-control" name="observaciones" size="1000" style="margin-left: 18px; width: 500px; height: 200px;"></textarea>                        
                        <br/><br/>
                          <input class="btn btn-default" type="submit" name="boton" value="Enviar" onclick="validar()" />                      
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>

                
<?php require('footer.php'); ?>

