<?php 
require('../lib/pdf/fpdf.php');
//$pdf = new FPDF();
#Creamos el objeto pdf (con medidas en milímetros): 
$pdf = new FPDF('P', 'mm', 'A4'); 

#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(25, 20 , 25); 

#Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true,20);  
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
 
$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(90,6, utf8_decode('REPORTE FINANCIERO DE PROYECTOS POR AÑO'),0,0,'C');
 
$pdf->Ln(10);
 
//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(80,6, utf8_decode('Año Lectivo'),1,0,'C',1);
 
$pdf->Cell(80,6,'Cantidad de Proyectos',1,0,'C',1); 
$pdf->Ln(5);

include '../model/conectar.php';
$resultado = mysql_query("SELECT anle.id_anle as ano_lectivo, COUNT(conv.ano_lectivo) as cantidad FROM ano_lectivo anle 
            LEFT JOIN  `convocatoria` conv  ON (conv.ano_lectivo = anle.id_anle) 
            LEFT JOIN  proyecto proy ON (proy.convocatoria = conv.id_convocatoria) 
            WHERE anle.id_anle BETWEEN 2013 AND 2015 
            GROUP BY 1 ORDER BY 1");
$tabla= array();
$i=1;
$pdf->SetFillColor(255,255,255); 
while($row = mysql_fetch_assoc($resultado))
{  
    $pdf->Cell(80,6, $row['ano_lectivo'], 1, 0,'C',1);
    $pdf->Cell(80,6, $row['cantidad'], 1, 0,'C',1);
    $pdf->Ln(5);
    if($row['cantidad']!=0){
        $tabla[$i] = $row['ano_lectivo'];
        $i=$i+1;
    }
}

 $i=1;      

 foreach($tabla as $t):     
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(90,6,'PROYECTOS EN EL '.$t,0); 
    $pdf->Ln(10);     
    $resultado = mysql_query("SELECT proy.nombre FROM `convocatoria` conv 
                LEFT JOIN  proyecto proy ON (proy.convocatoria = conv.id_convocatoria) 
                WHERE conv.ano_lectivo = ".$t." GROUP BY 1 ORDER BY 1");
    $pdf->SetFont('Arial','',10);  
    while($row = mysql_fetch_assoc($resultado))
    {  
        $pdf->Cell(80, 10, '- '.$row['nombre'], 0);
        $pdf->Ln(10);        
    }

    $i=$i+1;
 endforeach;

/*
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(80, 10, 'Esto es una celda de 40 x 10', 1);
$pdf->Cell(50, 10, 'Celda de 50 x 10', 1);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(80, 10, 'Esto es una celda de 40 x 10', 0);
$pdf->Cell(50, 10, 'Celda de 50 x 10', 0);*/
$pdf->Image('https://chart.googleapis.com/chart?chd=s:Uf9a&chdlp=t&chs=606x250&chm=N,333333,0,-1,11&chco=428bca,5cb85c,f0ad4e,d9534f&cht=bhs&chds=0,9&chxt=y,x&chxl=0:|diana&chd=t:pp&chtt=grafica hola',60,130,90,0,'PNG');

$pdf->Output('mipdf.pdf','i');

?>
   
