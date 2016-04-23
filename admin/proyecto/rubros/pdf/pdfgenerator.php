<?php
@session_start();
$nombres="";

       if ( $_SESSION['estado'] == "logeado" ) {
           //$nombres=$_SESSION['nombre'];
        
        } else {
          echo "<script language=Javascript> location.href='../../../index.php'; </script>";
        }




include 'class.ezpdf.php';
$pdf =new Cezpdf('FOLIO');
$pdf->selectFont('fonts/courier.afm');
$pdf->ezSetCmMargins(1,2,2,2);

include '../../../../model/conectar.php';
include '../../../../model/Proyecto.php';
include '../../../../model/ProyectoRubro.php';
include '../../../../model/contrapartida.php';
$proy=new Proyecto();
$proyRubro=new ProyectoRubro();
$cont = new contrapartida();
$id=$_GET['id'];




          $rubros = mysql_query("SELECT * FROM `proyecto_rubro` WHERE id_proyecto = '".$id."'");
          $rubros2 = mysql_query("SELECT * FROM `proyecto_rubro` WHERE id_proyecto = '".$id."'");
          $retiros = mysql_query("SELECT * FROM `movimiento_rubro` WHERE rubro_destino = 0 and id_proyecto = '".$id."'");
          $movimientos =  mysql_query("SELECT * FROM `movimiento_rubro` WHERE rubro_destino != 0 and id_proyecto = '".$id."'");
          $contrapartida = mysql_query("SELECT * FROM `proyecto_contrapartida` WHERE id_proyecto = '".$id."'");
          $contrapartidas= array();
          $rubro = array();
 
            while($contr = mysql_fetch_assoc($contrapartida)){  
                $contrapartidas[] = $contr;
            }
               

            while($datatmp = mysql_fetch_assoc($rubros)) {

                $contrapartida=$cont->buscarContrapartida($datatmp['id_contrapartida']);
          
                $data[] = array ('nombre'=>utf8_decode($contrapartida['nombre']), 
                            'valor'=>'$'.number_format(($datatmp['valor']), 2, ",", "."), 
                            'valor_disponible'=>'$'.number_format(($datatmp['valor_disponible']), 2, ",", "."), );
             }

            while($rub = mysql_fetch_assoc($rubros2)){  
                $rubro[] = $rub;
            }

            
           
            while($datatmp = mysql_fetch_assoc($retiros)) {
            
                $rubro_origen=$proyRubro->buscarProyectoRubro($datatmp['rubro_origen']);
                $contrOrigen=$cont->buscarContrapartida($rubro_origen['id_contrapartida']);
                $rubOrig = $contrOrigen['nombre'];

                $data2[] = array ('fecha'=>$datatmp['fecha'], 'rubro_origen'=>utf8_decode($rubOrig), 
                            'valor_solicitado'=>'$'.number_format(($datatmp['valor_solicitado']), 2, ",", "."),
                            'numero_orden'=>$datatmp['numero_orden'], 'observacion'=>utf8_decode($datatmp['observacion']));
             }

             while($datatmp = mysql_fetch_assoc($movimientos)) {

                $rubro_origen=$proyRubro->buscarProyectoRubro($datatmp['rubro_origen']);
                $contrOrigen=$cont->buscarContrapartida($rubro_origen['id_contrapartida']);
                $rubOrig = $contrOrigen['nombre'];

                $rubro_destino=$proyRubro->buscarProyectoRubro($datatmp['rubro_destino']);
                $contrDest=$cont->buscarContrapartida($rubro_destino['id_contrapartida']);
                $rubDest = $contrDest['nombre'];

                $data3[] = array ('fecha'=>$datatmp['fecha'], 'rubro_origen'=>utf8_decode($rubOrig), 
                            'valor_solicitado'=>'$'.number_format(($datatmp['valor_solicitado']), 2, ",", "."), 
                            'rubro_destino'=>utf8_decode($rubDest), 'numero_orden'=>$datatmp['numero_orden'], 
                            'observacion'=>utf8_decode($datatmp['observacion']));
             }
           
           
                         
             $proyecto=$proy->buscarProyecto($id);
             $totales= array();
             $totales[] = $proyecto['presupuesto'];

            $tablaT='';
            $contador=1;
                foreach($contrapartidas as $contr):    
                    $contador=$contador+1; 
                    $totales[] = $contr['total'];
                endforeach;

                foreach($rubro as $f):             
                    $tablaT=$tablaT.$f['id_contrapartida'].','.$f['valor'].',';

                    foreach($contrapartidas as $contr):    
                        $rub=explode(',',$contr['valor']);     
                        for($i=0; $i < count($rub) -1; $i=$i+2){
                            if($f['id_contrapartida'] == $rub[$i]){
                                $tablaT=$tablaT.$rub[$i+1].',';
                            }
                        }
                         
                        
                    endforeach;
                    
                endforeach;      


            $rub=explode(',',$tablaT);  
            $j=0;
            $datos=array();
            $tablaI=array();
            
            for($i=0; $i < count($rub)-1; $i=$i+1){
                $j=$j+1;                
                if($j == 1){
                    $contrapartida=$cont->buscarContrapartida($rub[$i]);
                    $datos['nombre' ] = utf8_decode($contrapartida['nombre']);
                }
                else{
                   $datos['contrapartida_'.$j] = '$'.number_format(($rub[$i]), 2, ",", ".");
                }
             
                if($j == $contador+1){
                    $j=0;
                    $tablaI[] = $datos;
                }

            }

            $datos['nombre' ] = 'TOTAL';
            $j=2;
            for($i=0; $i < count($totales); $i=$i+1){
                $datos['contrapartida_'.$j] = '$'.number_format(($totales[$i]), 2, ",", ".");
                $j=$j+1;                  
            }
            $tablaI[] = $datos;
           
                 
             $txttitle = "MOVIMIENTOS DE RUBROS\n PROYECTO:".$proyecto['nombre'];
            
            $titles = array(
            'nombre'=> 'RUBRO',
             'valor'=>'VALOR',
             'valor_disponible'=>'VALOR DISPONIBLE',
             );

            $titles2 = array(
            'fecha'=> 'FECHA',
             'rubro_origen'=>'RUBRO ORIGEN',
             'valor_solicitado'=>'VALOR SOLICITADO',
             'numero_orden'=>'NUMERO DE LA ORDEN',
             'observacion'=>'OBSERVACION',
            
             );

            $titles3 = array(
            'fecha'=> 'FECHA',
             'rubro_origen'=>'RUBRO ORIGEN',
             'valor_solicitado'=>'VALOR SOLICITADO',
             'rubro_destino'=>'RUBRO DESTINO',
             'numero_orden'=>'NUMERO DE LA ORDEN',
             'observacion'=>'OBSERVACION',
            
             );

            $titles4 = array();
            $i = 3;
            $titles4['nombre'] = 'RUBROS';
            $titles4['contrapartida_2'] = 'UFPS - FINU'; 

            foreach($contrapartidas as $contr):
                $titles4['contrapartida_'.$i] = $contr['nombre'];
                $i=$i+1;
            endforeach;
                

            $options = array(
             'showHeadings'=>1,
             'shadeCol'=> maroon,
             'xOrientation'=>'center',
             'width'=>850
             );
            
            $pdf->ezImage("../imagenes/logopdf.png", 0, 830, 'none', 'left');
            

             $pdf->ezText($txttitle, 14, array('justification'=>'center'));
             $pdf->ezText("Fecha: ".date("d/m/Y")."\n", 12, array('justification'=>'right'));
             $pdf->ezTable($data,$titles, '', $options);

             $pdf->ezText("\n\nPRESUPUESTO GLOBAL DEL PROYECTO\n");

             $pdf->ezTable($tablaI, $titles4, '', $options);

             $pdf->ezText("\n\nEJECUCION DEL PRESUPUESTO\n");

             $pdf->ezTable($data2,$titles2, '', $options);

             $pdf->ezText("\n\nCAMBIO DE RUBRO\n");

             $pdf->ezTable($data3,$titles3, '', $options);



             //$pdf->ezText("Hora: ".date("H:i:s")."\n\n", 10);
             $pdf->ezStream();
             

?>
