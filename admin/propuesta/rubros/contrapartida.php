<?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../index.php'; </script>";
   }

require "../../../model/contrapartida.php";

$cont=new contrapartida();
$id_propuesta=$_GET['id'];
$contrapartida=$cont->listaContrapartidaActiva();

?>
    <script type="text/javascript">
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
            <a href="../index.php">Propuesta</a>
        </li>
        <li>
            <a href="index.php">Rubros</a>
        </li>
        <li>
            <a href="#">Agregar Contrapartida</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Registar Contrapartida</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="form1" id="form1" action="../../../controller/propuestaContrapartida.php?opc=1">
                    <div class="form-group">
                      <input name="id_propuesta" type="hidden" id="id_propuesta" value="<?php echo $id_propuesta?>"/>
                      <label class="control-label" for="inputSuccess4">Nombre de la Contrapartida:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required >
                        <br/><br/>
                      <?php       
                        $i=1;                                
                        foreach($contrapartida as $cont):
                        ?> 
                         <label class="control-label" for="inputSuccess4"> <?php echo $cont['nombre']?>:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                         <input type="text" class="form-control" name="txtvalor<?php echo $cont['id_contrapartida']?>" required onkeypress="return permite(event, 'num')" >
                         <br/><br/>
                          <?php      
                          $i=$i+1;
                        endforeach;                                
                        ?>  
                                           
                                              
                    </div><br/><br/>
                    <input class="btn btn-default" type="submit" name="boton" value="Enviar" />
                    
                </form>

                <br/>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<?php require('footer.php'); ?>

