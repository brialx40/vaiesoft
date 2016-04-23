<?php

/**
 * Description of mes
 *
 * @author Diana Calderon
 */
class mes {
   
    public $id_mes;
    public $nombre;
    
    public function __construct() {
    }


public function buscarMes($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM mes WHERE id_mes='.$id);
        $meses= array();
         
        while($mes = mysql_fetch_assoc($resultado))
        {  $meses[] = $mes;}
        
            if(sizeof($meses)==0)
            {
                $meses[0]['nombre']=0;
                
            }
                
        mysql_close();   
 
        return $meses[0];
    }
    
    
    public function listaMes()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `mes` ');
        $meses= array();
 
        while($mes = mysql_fetch_assoc($resultado)){  
            $meses[] = $mes;
        }
               
        mysql_close();   
 
        return $meses;
    }

    public function eliminarMes($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM mes WHERE id_mes='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarMes($mes)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `mes` (`nombre`) VALUES ('".$mes[0]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarMes($id, $nuevoMes)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE `mes` SET  `nombre` =  '".$nuevoMes[0]."' WHERE `id_mes` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;
      
    }
    
}
?>
