<?php require('header.php'); 

session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "investigador" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }
$id_proyecto=$_GET['id'];
require "../../../../model/ano_lectivo.php";
$anle = new ano_lectivo();
$ano_lectivo=$anle->listaAnoLectivo();

?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;

            if(f.titulo.value == ''){
                alert('Por favor llene el campo Titulo');
                f.titulo.focus();
                condicion=false;
                return false;
            }

            if(f.numero_registro.value == ''){
                alert('Por favor llene el campo Numero de Registro');
                f.numero_registro.focus();
                condicion=false;
                return false;
            }

            if(f.ano_lectivo.value == ''){
                alert('Por favor seleccione un Año Lectivo');
                f.ano_lectivo.focus();
                condicion=false;
                return false;
            }

            if(f.descripcion.value == ''){
                alert('Por favor llene el campo Descripcion');
                f.descripcion.focus();
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
<div>
    <ul class="breadcrumb">
        <li>
          <a href="../../../index.php">Inicio</a>
        </li>
        <li>
          <a href="../../index.php">Proyecto</a>
        </li>
        <li>
          <a href="../index.php">Productos</a>
        </li>
        <li>
          <a href="index.php">Software</a>
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
                <h2><i class="glyphicon glyphicon-edit"></i> Agregar Software</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="for" id="for" action="../../../../controller/software.php?opc=1" onSubmit="return validar(this)">
                    <div class="form-group">
                        <br/>
                        <input name="id_proyecto" type="hidden" value="<?php echo $id_proyecto?>"/>
                        <label class="control-label" for="inputSuccess4">T&iacute;tulo: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="titulo" id="titulo" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">N&uacute;mero del registro aprobado por la Direcci&oacute;n Nacional de Derechos de Autor:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="numero_registro" id="numero_registro" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">A&ntilde;o: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <select name="ano_lectivo" id="ano_lectivo" data-rel="chosen" >
                          <option value="">Seleccione</option>
                          <?php       
                            $i=1;                                
                            foreach($ano_lectivo as $anle): 
                              echo '<option value="'.$anle['id_anle'].'">'.$anle['id_anle'].'</option>';                                      
                              $i=$i+1;
                            endforeach;                                
                          ?>
                        </select> 
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Descripci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <textarea  class="form-control" name="descripcion" size="1000" style="width: 229px; height: 100px;"></textarea>                        
                        <br/><br/>
                              
                          <input class="btn btn-default" type="submit" name="boton" value="Enviar" />                      
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>

                
<?php require('footer.php'); ?>

