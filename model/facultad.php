<?php

/**
 * Description of facultad
 *
 * @author Diana Calderon
 */
class facultad {
   
    public $id_facultad;
    public $nombre;
    
    public function __construct() {
    }


public function buscarFacultad($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM facultad WHERE id_facultad='.$id);
        $facultades= array();
         
        while($facultad = mysql_fetch_assoc($resultado))
        {  $facultades[] = $facultad;}
        
            if(sizeof($facultades)==0)
            {
                $facultades[0]['nombre']=0;
                
            }
                
        mysql_close();   
 
        return $facultades[0];
    }
    
    
    public function listaFacultad()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `facultad` ');
        $facultades= array();
 
        while($facultad = mysql_fetch_assoc($resultado)){  
            $facultades[] = $facultad;
        }
               
        mysql_close();   
 
        return $facultades;
    }

    public function eliminarFacultad($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM facultad WHERE id_facultad='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarFacultad($facultad)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `facultad` (`nombre`) VALUES ('".$facultad[0]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarFacultad($id, $nuevoFacultad)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE `facultad` SET  `nombre` =  '".$nuevoFacultad[0]."' WHERE `id_facultad` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;
      
    }
    
}
?>
