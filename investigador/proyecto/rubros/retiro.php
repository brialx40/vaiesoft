<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../index.php'; </script>";
   }

require "../../../model/ProyectoRubro.php";
require "../../../model/contrapartida.php"; 

$rubro=new ProyectoRubro();
$cont = new contrapartida();
$id=$_GET['id'];
$editar=$rubro->buscarProyectoRubro($id);

?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;

            if(parseInt(f.valor.value) < parseInt(f.valor_solicitado.value)){
                alert('Por favor el valor solicitado debe ser menor o igual al valor disponible.');
                f.valor_solicitado.focus();
                condicion=false;
                return false;
            }
            
            if( condicion!=false ) {    
                document.getElementById("form1").action="../../../controller/movimientoRubro.php?opc=1";
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
            <a href="../../index.php">Inicio</a>
        </li>
        <li>
            <a href="../index.php">Proyecto</a>
        </li>
        <li>
            <a href="index.php">Rubros</a>
        </li>
        <li>
            <a href="#">Ejecuci&oacute;n</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Ejecuci&oacute;n de Proyecto</h2>
            </div>
            <div class="box-content">
                <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
                    <div class="form-group">
                        <input name="id_pru" type="hidden" id="id_pru" value="<?php echo $editar['id_pru']?>"/>
                        <input name="id_proyecto" type="hidden" value="<?php echo $editar['id_proyecto']?>"/>
                        <label class="control-label" for="inputSuccess4">Rubro:</label>    
                        <?php
                          $contrapartida=$cont->buscarContrapartida($editar['id_contrapartida']);
                          echo '<input type="text" class="form-control" readonly value="'.$contrapartida['nombre'].'" >';
                        ?>                      
                         <br/><br/><label class="control-label" for="inputSuccess4">Valor Disponible:</label>
                        <input type="text" class="form-control" name="valor" id="valor" readonly value="<?php echo $editar['valor_disponible']?>" >
                         <br/><br/><label class="control-label" for="inputSuccess4">Valor Solicitado: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control"  name="valor_solicitado" id="valor_solicitado"  required onkeypress="return permite(event, 'num')" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4" >Fecha: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input name="fecha" class="form-control" type="date" id="fecha" value='<?php echo date ('Y-m-d')?>' style="width:230px" />
                        <br/><br/><label class="control-label" for="inputSuccess4">N&uacute;mero de la Orden:</label>
                        <input type="text" class="form-control" name="numero_orden">
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Observaci&oacute;n:</label>
                        <br/><textarea  class="form-control" name="observacion" size="1000" style="margin-left: 18px; width: 500px; height: 150px;"></textarea>                        
                    </div><br/><br/>
                    <input class="btn btn-default" type="submit" name="boton" value="Enviar" />                    
                </form>
            <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

</div><!--/row-->

<?php require('footer.php'); ?>

