<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../../model/ProyectoRubro.php";
require "../../../model/contrapartida.php"; 

$rubro=new ProyectoRubro();
$cont = new contrapartida();
$id=$_GET['id'];
$editar=$rubro->buscarProyectoRubro($id);
$valor_disponible = $editar['valor'] - $editar['valor_disponible'];

?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;

            if(f.valor.value < f.valor_disponible.value){
              alert('No se permite esta cantidad, debe ser un valor mayor o igual a '+f.valor_disponible.value);
              f.valor.focus();
              condicion=false;
              return false;
            }
            
            if( condicion!=false ) {    
                document.getElementById("form1").action="../../../controller/proyectoRubro.php?opc=2";
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
            <a href="#">Editar</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Actualizar Rubro</h2>
            </div>
            <div class="box-content">
                <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
                    <div class="form-group">
                        <input name="id_pru" type="hidden" id="id_pru" value="<?php echo $editar['id_pru']?>"/>
                        <input name="id_proyecto" type="hidden" value="<?php echo $editar['id_proyecto']?>"/>
                        <input name="valor_disponible" type="hidden" value="<?php echo $valor_disponible?>"/>
                        <label class="control-label" for="inputSuccess4">Rubro:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>    
                        <?php
                          $contrapartida=$cont->buscarContrapartida($editar['id_contrapartida']);
                          echo '<input type="text" class="form-control" readonly value="'.$contrapartida['nombre'].'" >';
                        ?>                      
                         <br/><br/><label class="control-label" for="inputSuccess4">Valor:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="valor" value="<?php echo $editar['valor']?>" required onkeypress="return permite(event, 'num')" >
                             
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

