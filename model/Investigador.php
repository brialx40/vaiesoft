<?php

/**
 * Description of Investigador
 *
 * @author Liliana
 */
class Investigador {
   
    public $cedula;
    public $nombre;
    public $apellido;    
    public $telefono;
    public $email;
    public $uno=0;
    
    public function __construct() {
        $this->uno=1;
    
}
public function buscarInvestigadorPorCedula($cedula)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM investigador WHERE cedula='.$cedula);
        $investigadores= array();
         
        while($investigador = mysql_fetch_assoc($resultado))
        {  $investigadores[] = $investigador;}
        
            if(sizeof($investigadores)==0)
              {
                   $investigadores[0]['cedula']=0;
                   $investigadores[1]['nombre']=0;
                   $investigadores[2]['apellido']=0;
                   $investigadores[3]['telefono']=0;
                   $investigadores[4]['email']=0;
                   
                
        }
                
        mysql_close();   
 
        return $investigadores[0];
    }

    public function buscarInvestigadorIdentificador($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM investigador WHERE id_investigador='.$id);
        $investigadores= array();
         
        while($investigador = mysql_fetch_assoc($resultado))
        {  $investigadores[] = $investigador;}
        
            if(sizeof($investigadores)==0)
              {
                   $investigadores[0]['cedula']=0;
                   $investigadores[1]['nombre']=0;
                   $investigadores[2]['apellido']=0;
                   $investigadores[3]['telefono']=0;
                   $investigadores[4]['email']=0;
                   
                
        }
                
        mysql_close();   
 
        return $investigadores[0];
    }
    
public function buscarInvestigadores()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `investigador` ');
        $investigadores= array();
 
        while($investigador = mysql_fetch_assoc($resultado)){  
            $investigadores[] = $investigador;
        }
               
        mysql_close();   
 
        return $investigadores;
    }
    
    public function eliminarInvestigador($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM investigador WHERE id_investigador='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarInvestigador($investigador)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `investigador` (`cedula`, `nombre`, `apellido`, `telefono`, `email`,`facultad`, `grupo`) 
                     VALUES ('".$investigador[0]."', '".$investigador[1]."', '".$investigador[2]."', '".$investigador[3]."', 
                        '".$investigador[4]."', '".$investigador[5]."', '".$investigador[6]."');");
        
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarInvestigador($id, $nuevoInvestigador)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `investigador` SET  `cedula` =  '".$nuevoInvestigador[0]."',
                      `nombre` =  '".$nuevoInvestigador[1]."', `apellido` =  '".$nuevoInvestigador[2]."', 
                      `telefono` =  '".$nuevoInvestigador[3]."', `email` =  '".$nuevoInvestigador[4]."' 
                      WHERE `id_investigador` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
     
            return true;
        
       
        
      
    }
    
}
?>
