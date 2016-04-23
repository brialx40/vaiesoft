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
             
            condicion=true;
            
            if(f.convocatoria.value == '0'){
                alert('Por favor seleccione una Convocatoria');
                f.convocatoria.focus();
                condicion=false;
                return false;
            }

            if(f.nombre.value == ''){
                alert('Por favor llene el campo Nombre');
                f.nombre.focus();
                condicion=false;
                return false;
            }

            if(f.objetivo.value == ''){
                alert('Por favor digite los objetivos de la propuesta');
                f.objetivo.focus();
                condicion=false;
                return false;
            }

            if(f.duracion.value == '0'){
                alert('Por favor seleccione la duracion del Propuesta');
                f.duracion.focus();
                condicion=false;
                return false;
            }

            if(f.facultad.value == '0'){
                alert('Por favor seleccione un Area del Conocimiento');
                f.facultad.focus();
                condicion=false;
                return false;
            }

            if(f.grupo.value == '0'){
                alert('Por favor seleccione un Grupo de Investigacion');
                f.grupo.focus();
                condicion=false;
                return false;
            }

            if(f.investigador_principal.value == '0'){
                alert('Por favor seleccione un Investigador Principal');
                f.investigador_principal.focus();
                condicion=false;
                return false;
            }

            if(f.horas_ip.value == ''){
                alert('Por favor llene el campo Dedicacion Horas/Semana');
                f.horas_ip.focus();
                condicion=false;
                return false;
            }

            if(f.evaluador_propuesta.value == ''){
                alert('Por favor seleccione el evaluador de la propuesta');
                f.evaluador_propuesta.focus();
                condicion=false;
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
    <script language="javascript">
      $(document).ready(function(){
         $("#facultad").change(function () {
            $("#facultad option:selected").each(function () {
            //alert($(this).val());
              elegido=$(this).val();
              $.post("../../script/comboFacultad.php", { elegido: elegido }, function(data){
              $("#facul").html(data);
              
            });     
              });
         })
        
      });
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
            <a href="#">Agregar</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Agregar Propuesta</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="for" id="for" action="../../controller/propuesta.php?opc=1" onSubmit="return validar(this)">
                    <div class="form-group">
                        <br/>
                              <label class="control-label" for="inputSuccess4">Convocatoria: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="convocatoria" id="convocatoria" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                              <?php       
                                $i=1;
                                
                             foreach($convocatorias as $con): 
                                echo '<option value="'.$con['id_convocatoria'].'">'.$con['nombre'].'</option>';
                                    
                                $i=$i+1;
                              endforeach;                                
                            ?>
                            </select> <br/><br/>
                              <label class="control-label" for="inputSuccess4">Nombre: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input type="text" class="form-control" name="nombre" id="nombre" onkeypress="return permite(event, 'car')">
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">Objetivos de la Propuesta: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <br/><textarea  class="form-control" name="objetivos" size="1000" style="margin-left: 18px; width: 500px; height: 200px;"></textarea>                        
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">Duracion: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="duracion" id="duracion" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                                <option value="1 Semestre">1 Semestre</option>
                                <option value="2 Semestres">2 Semestres</option>
                                <option value="3 Semestres">3 Semestres</option>
                                <option value="4 Semestres">4 Semestres</option>
                              </select> <br/><br/>
                              <label for="fechaInicio" id="fechaInicio" >Fecha Inicio: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input name="fechaInicio" class="form-control" type="date" id="fechaInicio" value='<?php echo date ('Y-m-d')?>' style="width:230px" />
                              <br/><br/>
                              <label for="fechafinalizacion" id="fechaFinalizacion"  >Fecha Finalizaci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <input name="fechaFin" class="form-control" type="date" id="fechaFin" value='<?php echo date ('Y-m-d')?>'  style="width:230px" />
                              <br/><br/>
                              <label class="control-label" for="inputSuccess4">&Aacute;rea de Conocimiento: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="facultad" id="facultad" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                              <?php       
                                $i=1;                                
                               foreach($facultad as $fal): 
                                  echo '<option value="'.$fal['id_facultad'].'">'.$fal['nombre'].'</option>';                                      
                                  $i=$i+1;
                                endforeach;                                
                              ?>
                              </select> 
                              <br/><br/>
                              <div id="facul">
                              <label class="control-label" for="inputSuccess4">Grupo de Investigaci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                              <select name="grupo" id="grupo" data-rel="chosen" >
                                <option value="0">Seleccione</option>
                              <?php       
                                $i=1;                                
                               foreach($grupos as $gru): 
                                  echo '<option value="'.$gru['id_grupo'].'">'.$gru['siglas'].'</option>';                                      
                                  $i=$i+1;
                                endforeach;                                
                              ?>
                              </select>
                              <br/><br/>
                            </div>
                        <label class="control-label" for="inputSuccess4">Investigador Principal: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <select name="investigador_principal" id="investigador_principal" data-rel="chosen" >
                          <option value="0">Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                    
                            $i=$i+1;
                          endforeach;                                
                        ?>
                        </select> <br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="horas_ip" id="horas_ip" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">CoInvestigador 1:</label>
                        <select name="coinvestigador1" id="coinvestigador1" data-rel="chosen" >
                          <option value="0"> Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                    
                            $i=$i+1;
                          endforeach;                                
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                        <input type="text" class="form-control" name="horas_ci1" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">CoInvestigador 2:</label>
                        <select name="coinvestigador2" id="coinvestigador2" data-rel="chosen" >
                          <option value="0">Seleccione </option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                    
                            $i=$i+1;
                          endforeach;                                
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                        <input type="text" class="form-control" name="horas_ci2" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">CoInvestigador 3:</label>
                        <select name="coinvestigador3" id="coinvestigador3" data-rel="chosen" >
                          <option value="0"> Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($investigadores as $inv): 
                            echo '<option value="'.$inv['id_investigador'].'">'.$inv['nombre'].' '.$inv['apellido'].'</option>';
                                    
                            $i=$i+1;
                          endforeach;                                
                        ?>
                        </select><br/><br/>
                        <label class="control-label" for="inputSuccess4">Dedicaci&oacute;n Horas/Semana:</label>
                        <input type="text" class="form-control" name="horas_ci3" >
                        <br/><br/>  
                        <label class="control-label" for="inputSuccess4">N&uacute;mero del Convenio:</label>
                        <input type="text" class="form-control" name="numero_convenio" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Nombre del Convenio:</label>
                        <input type="text" class="form-control" name="nombre_convenio">    
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Evaluador de la Propuesta: </label>
                        <select name="evaluador_propuesta" id="evaluador_propuesta" data-rel="chosen" >
                          <option value="0">Seleccione</option>
                        <?php       
                         $i=1;
                          foreach($evaluadores as $eva): 
                            echo '<option value="'.$eva['id_evaluador'].'">'.$eva['nombre'].' '.$eva['apellido'].'</option>';
                                    
                            $i=$i+1;
                          endforeach;                                
                        ?>
                        </select> <br/><br/>
                        
                        <label class="control-label" for="inputSuccess4">Observaciones de la Propuesta:</label>
                        <br/><textarea  class="form-control" name="observaciones" size="1000" style="margin-left: 18px; width: 500px; height: 200px;"></textarea>                        
                        <br/><br/>
                          <input class="btn btn-default" type="submit" name="boton" value="Enviar" />                      
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>

                
<?php require('footer.php'); ?>

