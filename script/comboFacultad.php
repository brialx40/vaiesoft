<?php
require "../model/grupo.php";
$grup = new grupo();

$id = $_POST["elegido"];

if ($id != '' and $id != '0'){
  $grupos=$grup->listaGrupoPorFacultad($id);
  echo ' <label class="control-label" for="inputSuccess4">Grupo de Investigaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 12pt;">*</span></label>
      <select name="grupo" id="grupo" style="position: relative; overflow: hidden; padding: 0 0 0 8px; height: 38px; 
                 width: 229px; border: 1px solid #aaa; border-radius: 5px; background-color: #fff;
                  background: -webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#fff),color-stop(50%,#f6f6f6),color-stop(52%,#eee),color-stop(100%,#f4f4f4));
                 background: -webkit-linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
                 background: -moz-linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
                 background: -o-linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
                 background: linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
                  background-clip: padding-box;
                   box-shadow: 0 0 3px #fff inset,0 1px 1px rgba(0,0,0,.1);
                   color: #444; text-decoration: none; white-space: nowrap; line-height: 34px;font-size: 13px;" >
        <option value="0">Seleccione</option>';
     
        $i=1;                                
        foreach($grupos as $gru): 
          echo '<option value="'.$gru['id_grupo'].'">'.$gru['siglas'].'</option>';                                      
          $i=$i+1;
        endforeach;                                
        echo '</select>
            <br/><br/>'; 
}else {

}

?>
