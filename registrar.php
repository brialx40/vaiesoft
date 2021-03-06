<?php require('head.php'); 

require "model/facultad.php";
require "model/grupo.php";

    
require_once ( 'lib/class.phpmailer.php');

require_once ( 'lib/class.smtp.php');


$facul = new facultad();
$facultad=$facul->listaFacultad();

$grup = new grupo();
$grupos=$grup->listaGrupo();

?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;
            
            if(f.cedula.value == ''){
                alert('Por favor llene el campo Identificacion');
                f.cedula.focus();
                condicion=false;
                return false;
            }

            if(f.nombre.value == ''){
                alert('Por favor llene el campo Nombres');
                f.nombre.focus();
                condicion=false;
                return false;
            }

            if(f.apellido.value == ''){
                alert('Por favor llene el campo Apellidos');
                f.apellido.focus();
                condicion=false;
                return false;
            }
            
            if(f.telefono.value == ''){
                alert('Por favor llene el campo Celular');
                f.telefono.focus();
                condicion=false;
                return false;
            }

            if(f.email.value == ''){
                alert('Por favor llene el campo Email');
                f.email.focus();
                condicion=false;
                return false;
            }

            if(f.facultad.value == 0){
              alert('Por favor seleccione un Area de Conocimiento');
              f.facultad.focus();
              condicion=false;
              return false;
            }

            if(f.grupo.value == 0){
              alert('Por favor seleccione un Grupo de Investigacion');
              f.grupo.focus();
              condicion=false;
              return false;
            }

            if(f.clave.value == ''){
                alert('Por favor llene el campo Contraseña');
                f.clave.focus();
                condicion=false;
                return false;
            }


                        
            if( condicion!=false ) {    
                document.getElementById("form1").action="controller/investigador.php?opc=4";
                document.getElementById("form1").submit();  
     
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
    <script language="javascript">
      $(document).ready(function(){
         $("#facultad").change(function () {
            $("#facultad option:selected").each(function () {
            //alert($(this).val());
              elegido=$(this).val();
              $.post("script/comboFacultad.php", { elegido: elegido }, function(data){
              $("#facul").html(data);
              
            });     
              });
         })
        
      });
    </script>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Inicio</a>
        </li>
        <li>
            <a href="#">Registrar Investigador</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Registrar Investigador</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
                    <div class="form-group">
                        <label class="control-label" for="inputSuccess4">Identificaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="cedula" id="cedula" onkeypress="return permite(event, 'num')">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Nombres:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="nombre" id="nombre" onKeyUp="this.value=this.value.toUpperCase();" onkeypress="return permite(event, 'car')">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Apellidos:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="apellido" id="apellido" onKeyUp="this.value=this.value.toUpperCase();" onkeypress="return permite(event, 'car')">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Celular:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="telefono" id="telefono" onkeypress="return permite(event, 'num')">
                        <br/><br/>
                        <label for="exampleInputEmail1">Email:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" id="email" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">&Aacute;rea de Conocimiento: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <select name="facultad" id="facultad" data-rel="chosen" required>
                          <option value="0">Seleccione</option>
                          <?php       
                            $i=1;                                
                            foreach($facultad as $fal): 
                              echo '<option value="'.$fal['id_facultad'].'">'.$fal['nombre'].'</option>';                                      
                              $i=$i+1;
                            endforeach;                                
                          ?>
                        </select> <br><br>
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
                          <br>
                        </div>
                        <br>
                        <label class="control-label" for="inputSuccess4">Contrase&ntilde;a:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="password" class="form-control" name="clave" id="clave" >
                        
                    </div><br><br>
                    <input class="btn btn-default" type="submit" name="boton" value="Registrarse" />
                    
                </form>

                <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

</div><!--/row-->

<?php require('footer.php'); ?>

