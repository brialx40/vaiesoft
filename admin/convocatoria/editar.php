<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }
  
require "../../model/convocatoria.php";
$conv=new convocatoria();
$id=$_GET['id'];
$editar=$conv->buscarConvocatoria($id);

require "../../model/ano_lectivo.php";
$ano_lectivo = new ano_lectivo();
$ano_lectivos=$ano_lectivo->listaAnoLectivo();

?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;
            
            if(f.nombre.value == ''){
                alert('Por favor llene el campo Nombre');
                f.nombre.focus();
                condicion=false;
                return false;
            }

            if(f.ano_lectivo.value == ''){
                alert('Por favor seleccione un Año Lectivo');
                f.ano_lectivo.focus();
                condicion=false;
                return false;
            }

            

            if(f.fechaInicio.value == ''){
                alert('Por favor seleccione una fecha inicio para la Convocatoria');
                f.fechaInicio.focus();
                condicion=false;
                return false;
            }

            if(f.fechaFin.value == ''){
                alert('Por favor seleccione una fecha fin para la Convocatoria');
                f.fechaFin.focus();
                condicion=false;
                return false;
            }
                        
            if( condicion!=false ) {    
                document.getElementById("form1").action="../../controller/convocatoria.php?opc=2";
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
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Convocatoria</a>
        </li>
        <li>
            <a href="#">Editar</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Actualizar Convocator&iacute;a</h2>
            </div>
            <div class="box-content">
                <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
                    <div class="form-group">
                        <input name="id_convocatoria" type="hidden" id="id_convocatoria" value="<?php echo $editar['id_convocatoria']?>"/>
                        <label class="control-label" for="inputSuccess4">Nombre:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $editar['nombre']?>" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">A&ntilde;o Lectivo:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>                        
                          <select name="ano_lectivo" id="ano_lectivo" data-rel="chosen" style="width:230px">
                            <?php       
                              $i=1;
                              
                           foreach($ano_lectivos as $ano): 
                              echo '<option ';
                              if ($ano['id_anle'] == $editar['ano_lectivo'] ){
                                echo ' selected ';
                              }
                              echo ' value="'.$ano['id_anle'].'">'.$ano['id_anle'].'</option>';
                                  
                              $i=$i+1;
                            endforeach;                                
                          ?>
                          </select>                                               
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Fecha Inicio:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input name="fechaInicio" class="form-control" type="date" id="fechaInicio" value="<?php echo $editar['fecha_inicio']?>" style="width:230px" />
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Fecha Fin:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input name="fechaFin" class="form-control" type="date" id="fechaFin" value="<?php echo $editar['fecha_fin']?>" style="width:230px" />
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Estado:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>                        
                        <select name="estado" id="estado" style="width:230px"  data-rel="chosen">
                          <option value="ACTIVO"  <?phpif ($editar['estado'] == 'ACTIVO'){echo ' selected ';} ?> >ACTIVO</option>
                          <option value="INACTIVO" <?phpif ($editar['estado'] == 'INACTIVO'){echo ' selected ';} ?> >INACTIVO</option>
                        </select>
                    </div><br/><br/>
                    <input class="btn btn-default" type="submit" name="boton" value="Actualizar" />                    
                </form>
            <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

</div><!--/row-->

<?php require('footer.php'); ?>

