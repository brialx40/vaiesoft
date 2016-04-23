<?php require('header.php'); 

session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../index.php'; </script>";
   }

require "../../../model/contrapartida.php";

$cont=new contrapartida();
$id_propuesta=$_GET['id'];
$id_investigador=$_GET['inv'];
$contrapartida=$cont->listaContrapartidaDisponibles($id_propuesta);

?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;

            if(f.contrapartida.value == ''){
                alert('Por favor seleccione un rubro');
                f.contrapartida.focus();
                condicion=false;
                return false;
            }
               
            if( condicion!=false ) {    
                document.getElementById("form1").action="../../../controller/propuestaRubro.php?opc=5";
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

function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}

function txNombres() {
 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
  event.returnValue = false;
}
        
    </script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../../index.php">Inicio</a>
        </li>
        <li>
            <a href="../index.php">Propuesta</a>
        </li>
        <li>
            <a href="index.php">Rubros</a>
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
                <h2><i class="glyphicon glyphicon-edit"></i> Registar Rubros</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
                    <div class="form-group">
                      <input name="id_propuesta" type="hidden" value="<?php echo $id_propuesta?>"/>
                      <input name="id_investigador" type="hidden" value="<?php echo $id_investigador?>"/>
                      <label class="control-label" for="inputSuccess4">Rubro:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>                        
                          <select name="contrapartida" data-rel="chosen">
                            <option value=''>Seleccione</option>
                            <?php       
                              $i=1;                                
                              foreach($contrapartida as $cont): 
                                echo '<option value="'.$cont['id_contrapartida'].'">'.$cont['nombre'].'</option>';
                                
                                $i=$i+1;
                              endforeach;                                
                            ?>  
                          </select> 
                        <br/><br/><label class="control-label" for="inputSuccess4">Valor:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="valor" required onkeypress="ValidaSoloNumeros()" >
                                               
                                              
                    </div><br/><br/>
                    <input class="btn btn-default" type="submit" name="boton" value="Enviar" />
                    
                </form>

                <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<?php require('footer.php'); ?>

