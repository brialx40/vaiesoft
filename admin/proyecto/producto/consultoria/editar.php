<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

require "../../../../model/libro.php";

$lib=new libro();
$id=$_GET['id'];
$editar=$lib->buscarLibro($id);

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

            if(f.numero_contrato.value == ''){
                alert('Por favor llene el campo Numero de Contrato');
                f.numero_contrato.focus();
                condicion=false;
                return false;
            }
           
            if(f.fecha.value == ''){
                alert('Por favor seleccione una Fecha');
                f.fecha.focus();
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
          <a href="index.php">Consultor&iacute;a Cient&iacute;fico-Tecnol&oacute;gica</a>
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
                <h2><i class="glyphicon glyphicon-edit"></i> Editar Consulto&iacute;a Cient&iacute;fico-Tecnol&oacute;gica</h2>
            </div>
            <div class="box-content">
                
                <form class="form-inline" role="form" method="post" name="for" id="for" action="../../../../controller/libro.php?opc=2" onSubmit="return validar(this)" >
                    <div class="form-group">
                        <br/>
                        <input name="id_libro" type="hidden" value="<?php echo $id?>"/>
                        <input name="id_proyecto" type="hidden" value="<?php echo $editar['id_proyecto']?>"/>
                        <label class="control-label" for="inputSuccess4">T&iacute;tulo: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $editar['titulo']?>">
                        <br/><br/>
                        <label class="control-label" title="Numero de contrato o documento que soporta la realizacion de la consultoria" for="inputSuccess4">N&uacute;mero de Contrato:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input type="text" class="form-control" name="numero_contrato" id="numero_contrato" value="<?php echo $editar['numero_contrato']?>" >
                        <br/><br/>
                        <label class="control-label" for="inputSuccess4">Fecha: <span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                        <input name="fecha" class="form-control" type="date" id="fecha" value="<?php echo $editar['fecha']?>" style="width:230px" />
                        <br/><br/>  
                        <input class="btn btn-default" type="submit" name="boton" value="Actualizar"  />
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>


<?php require('footer.php'); ?>

