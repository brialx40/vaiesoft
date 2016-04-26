<?php require('header.php'); 
@session_start();
$nombres="";


if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "representante") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
} else {
  echo "<script language=Javascript> location.href='../../index.php'; </script>";
}
?>
<script type="text/javascript">
      function validar(f) {

        condicion=true;
        if(f['disciplinas[]'].selectedIndex < 0){
          alert('Por favor llene el campo de Disciplinas');         
          condicion=false;
          return false;
        }
        
        if(f.identificacion.value == ''){
          alert('Por favor llene el campo Identificacion');
          f.identificacion.focus();
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
          document.getElementById("form1").action="../../controller/evaluador.php?opc=1";
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
        <a href="index.php">filtro</a>
    </li>  
     <li>
        <a href="lista.php">Evaluador</a>
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
        <h2><i class="glyphicon glyphicon-edit"></i> Registar Evaluador</h2>
      </div>
      <div class="box-content">

        <form class="form-inline" role="form" method="post" name="form1" id="form1" onSubmit="return validar(this)">
          <div class="form-group">
            <label class="control-label" for="inputSuccess4">Identificaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
            <input type="text" class="form-control" name="identificacion" id="identificacion" onkeypress="return permite(event, 'num')">
            <br/><br/>
            <label class="control-label" for="inputSuccess4">Nombres:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
            <input type="text" class="form-control" name="nombre" id="nombre" onKeyUp="this.value=this.value.toUpperCase();" onkeypress="return permite(event, 'car')">
            <br/><br/>
            <label class="control-label" for="inputSuccess4">Apellidos:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
            <input type="text" class="form-control" name="apellido" id="apellido"  onKeyUp="this.value=this.value.toUpperCase();" onkeypress="return permite(event, 'car')">
            <br/><br/>
            <label class="control-label" for="inputSuccess4">Tel&eacute;fono:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
            <input type="text" class="form-control" name="telefono" id="telefono" onkeypress="return permite(event, 'num')">
            <br/><br/>
            <label for="exampleInputEmail1">Email:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
            <input type="email" class="form-control" name="email" id="email" >
            <br/><br/>
            <label for="exampleInputEmail1">Url CvLAC:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
            <input type="url" class="form-control" placeholder="http://www.example.com/" name="urlcvlac" id="urlcvlac">
            <br/><br/>
            <label for="exampleInputEmail1">Disciplinas:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
                      
             <select class="selectpicker" name="disciplinas[]" id="disciplinas[]" multiple>             
              <?php
              require "../../model/facultad.php";
              require "../../model/PlanEstudio.php";
              $fac = new facultad();
              $facultades=$fac->listaFacultad();
              foreach($facultades as $f): 
                echo '<optgroup label="'.$f['nombre'].'">';
                      
                      $plan= new PlanEstudio();
                      $planes= $plan->listarPlanEstudioFacultad($f['id_facultad']);
                      foreach($planes as $p):
                          echo ' <option value="'.$p['id_plan'].'">'.utf8_encode($p['nombre']).'</option> ';
                      endforeach;
                echo '</optgroup>';
              endforeach;            
              ?>
            </select>

            
            <br/><br/>
          
         
          <br/><br/>
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

