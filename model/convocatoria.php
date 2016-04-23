<?php

/**
 * Description of convocatoria
 *
 * @author Diana Calderon
 */
class convocatoria {
   
    public $id_convocatoria;
    public $nombre;
    public $ano_lectivo;    
    public $fechaInicio;
    public $fechaFin;
    public $estado;
    
    public function __construct() {
    }
public function buscarConvocatoriaPorAno($ano_lectivo)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM convocatoria WHERE ano_lectivo='.$ano_lectivo);
        $convocatorias= array();
         
        while($convocatoria = mysql_fetch_assoc($resultado))
        {  $convocatorias[] = $convocatoria;}
        
            if(sizeof($convocatorias)==0)
              {
                   $convocatorias[0]['nombre']=0;
                   $convocatorias[1]['ano_lectivo']=0;
                   $convocatorias[2]['fecha_inicio']=0;
                   $convocatorias[3]['fecha_fin']=0;
                   $convocatorias[4]['estado']=0;                  
                
        }
                
        mysql_close();   
 
        return $convocatorias[0];
    }

public function buscarConvocatoria($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM convocatoria WHERE id_convocatoria='.$id);
        $convocatorias= array();
         
        while($convocatoria = mysql_fetch_assoc($resultado))
        {  $convocatorias[] = $convocatoria;}
        
            if(sizeof($convocatorias)==0)
              {
                   $convocatorias[0]['nombre']=0;
                   $convocatorias[1]['ano_lectivo']=0;
                   $convocatorias[2]['fechaInicio']=0;
                   $convocatorias[3]['fechaFin']=0;
                   $convocatorias[4]['estado']=0;
                   
                
        }
                
        mysql_close();   
 
        return $convocatorias[0];
    }
    
    
    public function listaConvocatorias()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `convocatoria` ');
        $convocatorias= array();
 
        while($convocatoria = mysql_fetch_assoc($resultado)){  
            $convocatorias[] = $convocatoria;
        }
               
        mysql_close();   
 
        return $convocatorias;
    }

    public function listaConvocatoriasActivas()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `convocatoria` WHERE estado = "ACTIVO"');
        $convocatorias= array();
 
        while($convocatoria = mysql_fetch_assoc($resultado)){  
            $convocatorias[] = $convocatoria;
        }
               
        mysql_close();   
 
        return $convocatorias;
    }
    
    public function eliminarConvocatoria($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM convocatoria WHERE id_convocatoria='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarConvocatoria($convocatoria)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `convocatoria` (`nombre`, `ano_lectivo`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES ('".$convocatoria[0]."', '".$convocatoria[1]."', '".$convocatoria[2]."', '".$convocatoria[3]."', '".$convocatoria[4]."');");
        
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarConvocatoria($id, $nuevoConvocatoria)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `convocatoria` SET  `nombre` =  '".$nuevoConvocatoria[0]."',`ano_lectivo` =  '".$nuevoConvocatoria[1]."', `fecha_inicio` =  '".$nuevoConvocatoria[2]."', `fecha_fin` =  '".$nuevoConvocatoria[3]."', `estado` =  '".$nuevoConvocatoria[4]."' WHERE `id_convocatoria` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
     
            return true;
        
       
        
      
    }
    
}
?>
