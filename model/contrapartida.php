<?php

/**
 * Description of contrapartida
 *
 * @author Diana Calderon
 */
class contrapartida {
   
    public $id_contrapartida;
    public $nombre;
    public $estado;
    
    public function __construct() {
    }


public function buscarContrapartida($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM contrapartida WHERE id_contrapartida='.$id);
        $contrapartidas= array();
         
        while($contrapartida = mysql_fetch_assoc($resultado))
        {  $contrapartidas[] = $contrapartida;}
        
            if(sizeof($contrapartidas)==0)
            {
                $contrapartidas[0]['nombre']=0;
                
            }
                
        mysql_close();   
 
        return $contrapartidas[0];
    }
    
    
    public function listaContrapartida()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `contrapartida` ');
        $contrapartidas= array();
 
        while($contrapartida = mysql_fetch_assoc($resultado)){  
            $contrapartidas[] = $contrapartida;
        }
               
        mysql_close();   
 
        return $contrapartidas;
    }

    public function eliminarContrapartida($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM contrapartida WHERE id_contrapartida='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarContrapartida($contrapartida)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `contrapartida` (`nombre`, `estado` ) VALUES ('".$contrapartida[0]."', '".$contrapartida[1]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarContrapartida($id, $nuevoContrapartida)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE `contrapartida` SET  `nombre` =  '".$nuevoContrapartida[0]."', `estado` =  '".$nuevoContrapartida[1]."' WHERE `id_contrapartida` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;
      
    }

    public function listaContrapartidaActiva()
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `contrapartida` WHERE `estado` = 'ACTIVO'");
        $contrapartidas= array();
 
        while($contrapartida = mysql_fetch_assoc($resultado)){  
            $contrapartidas[] = $contrapartida;
        }
               
        mysql_close();   
 
        return $contrapartidas;
    }
    
    public function cantidadContrapartidaActiva()
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `contrapartida` WHERE `estado` = 'ACTIVO'");

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }

    public function cantidadContrapartidas()
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `contrapartida`");

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }

    public function listaContrapartidaDisponibles($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM contrapartida WHERE id_contrapartida NOT IN (
                              SELECT id_contrapartida FROM proyecto_rubro WHERE id_proyecto = '".$id_proyecto."')");
        $contrapartidas= array();
 
        while($contrapartida = mysql_fetch_assoc($resultado)){  
            $contrapartidas[] = $contrapartida;
        }
               
        mysql_close();   
 
        return $contrapartidas;
    }
}
?>
