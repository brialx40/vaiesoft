<?php

/**
 * Description of grupo
 *
 * @author Diana Calderon
 */
class grupo {
   
    public $id_grupo;
    public $siglas;
    public $nombre;
    public $facultad;
    
    public function __construct() {
    }


public function buscarGrupo($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM grupo_investigacion WHERE id_grupo='.$id);
        $grupos= array();
         
        while($grupo = mysql_fetch_assoc($resultado))
        {  $grupos[] = $grupo;}
        
            if(sizeof($grupos)==0)
            {
                $grupos[0]['siglas']=0;
                $grupos[0]['nombre']=0;
                $grupos[0]['facultad']=0;
                
            }
                
        mysql_close();   
 
        return $grupos[0];
    }
    
    
    public function listaGrupo()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `grupo_investigacion` ');
        $grupos= array();
 
        while($grupo = mysql_fetch_assoc($resultado)){  
            $grupos[] = $grupo;
        }
               
        mysql_close();   
 
        return $grupos;
    }

    public function listaGrupoPorFacultad($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `grupo_investigacion` WHERE `id_facultad` = '.$id);
        $grupos= array();
 
        while($grupo = mysql_fetch_assoc($resultado)){  
            $grupos[] = $grupo;
        }
               
        mysql_close();   
 
        return $grupos;
    }

    public function eliminarGrupo($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM grupo_investigacion WHERE id_grupo='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarGrupo($grupo)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `grupo_investigacion` (`siglas`, `nombre`, `id_facultad`) VALUES ('".$grupo[0]."', '".$grupo[1]."', '".$grupo[2]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarGrupo($id, $nuevoGrupo)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE `grupo_investigacion` SET  `siglas` =  '".$nuevoGrupo[0]."', `nombre` =  '".$nuevoGrupo[1]."', `id_facultad` =  '".$nuevoGrupo[2]."' WHERE `id_grupo` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;
      
    }
    
}
?>
