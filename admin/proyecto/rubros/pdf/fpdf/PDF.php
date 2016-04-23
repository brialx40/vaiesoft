<?php
require('fpdf.php');
 
class PDF extends FPDF
{
    function cabeceraVertical($cabecera)
    {
        $this->SetXY(10, 10);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $columna)
        {
            //Parámetro con valor 2, hace que la cabecera sea vertical
            $this->Cell(30,7, utf8_decode($columna),1, 2 , 'L' );
        }
    }
 
    function datosVerticales($datos)
    {
        $this->SetXY(40, 10); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',10); //Fuente, Normal, tamaño
        foreach($datos as $columna)
        {
            $this->Cell(30,7, utf8_decode($columna),1, 2 , 'L' );
        }
    }
 
    function cabeceraHorizontal($cabecera)
    {
        //$this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(54,7, utf8_decode($fila),1, 0 , 'L' );
        }
    }
 
    function datosHorizontal($datos)
    {
       // $this->SetXY(10,77); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',10); //Fuente, normal, tamaño
        foreach($datos as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(54,7, utf8_decode($fila),1, 0 , 'L' );
        }
    }
 
} // FIN Class PDF
?>