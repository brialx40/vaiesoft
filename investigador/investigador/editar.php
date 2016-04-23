<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/Investigador.php";
$invedit=new Investigador();
$id=$_GET['id'];
$editar=$invedit->buscarInvestigadorIdentificador($id);
?>
    <script type="text/javascript">
        function validar(f) {
             
            condicion=true;
            
            if(f.cedula.value == ''){
                alert('Por favor llene el campo Identificación');
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
                alert('Por favor llene el campo Telefono');
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
                        
            if( condicion!=false ) {    
                document.getElementById("form1").action="../../controller/investigador.php?opc=2";
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
            <a href="index.php">Investigador</a>
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
                <h2><i class="glyphicon glyphicon-edit"></i> Actualizar Investigador</h2>
            </div>
            <div class="box-content">
                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
              <div class="form-group">
                <input name="id_investigador" type="hidden" id="id_investigador" value="<?php echo $editar['id_investigador']?>"/>
                <label class="control-label" for="inputSuccess4">Identificaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                <input type="text" class="form-control" name="cedula" id="cedula" value="<?php echo $editar['cedula']?>" onkeypress="return permite(event, 'num')">
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Nombres:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                <input type="text" class="form-control" name="nombre" id="nombre" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $editar['nombre']?>" onkeypress="return permite(event, 'car')">
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Apellidos:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                <input type="text" class="form-control" name="apellido" id="apellido" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $editar['apellido']?>" onkeypress="return permite(event, 'car')">
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Tel&eacute;fono:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $editar['telefono']?>" onkeypress="return permite(event, 'num')">
                <br/><br/>
                <label for="exampleInputEmail1">Email:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" id="email" value="<?php echo $editar['email']?>" >
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

