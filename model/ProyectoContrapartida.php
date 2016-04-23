<?php


/**
 * Description of proyecto_contrapartida
 *
 * @author Diana Calderon
 */
class ProyectoContrapartida {
    
    public $id_proyecto;
    public $valor;

    public function __construct() {

    }
 
    
public function agregarProyectoContrapartida($proyecto_contrapartida)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `proyecto_contrapartida` (`id_proyecto`, `nombre`, `valor`, `total`) VALUES ('".$proyecto_contrapartida[0]."', '".$proyecto_contrapartida[1]."', '".$proyecto_contrapartida[2]."', '".$proyecto_contrapartida[3]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 

  public function editarProyectoContrapartida($id_pru, $nuevaContrapartida)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto_contrapartida` SET  `nombre` =  '".$nuevaContrapartida[1]."', `valor` =  '".$nuevaContrapartida[2]."', `total` =  '".$nuevaContrapartida[3]."' WHERE `id_pru` =  '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
      
    }

     public function eliminarProyectoContrapartida($id_pru)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM proyecto_contrapartida WHERE id_pru='".$id_pru."'" );
        
        mysql_close();
        
        return true;
    }  
    
public function buscarContrapartidaPorProyecto($id_proyecto)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM proyecto_contrapartida WHERE id_proyecto = '".$id_proyecto."'");
        $contrapartidas= array();
    
        while($contrapartida = mysql_fetch_row($resultado))
        {   $contrapartidas[] = $contrapartida;}

        mysql_close(); 
        
       return $contrapartidas[0];         
     
    }

    public function buscarProyectoContrapartida($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM proyecto_contrapartida WHERE id_pru='.$id);
        $contrapartidas= array();
         
        while($contrapartida = mysql_fetch_assoc($resultado))
        {  $contrapartidas[] = $contrapartida;}
                        
        mysql_close();   
 
        return $contrapartidas[0];
    } 

    public function listaContrapartidaPorProyecto($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `proyecto_contrapartida` WHERE id_proyecto = '".$id_proyecto."'");
        $contrapartidas= array();
 
        while($contrapartida = mysql_fetch_assoc($resultado)){  
            $contrapartidas[] = $contrapartida;
        }
               
        mysql_close();   
 
        return $contrapartidas;
    }
    
    
 public function UpdateProyectoRubro($id_proyecto, $id_pru, $valorInicial)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  proyecto_contrapartida SET  valor =  '".$valorInicial."' WHERE id_proyecto LIKE  '".$id_proyecto."' AND  id_pru=".$id_pru);
        
        mysql_close();
        
        if($resultado==1)
            return true;
        return false;
    }

public function ExistenRubrosPorProyecto($id_proyecto)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM proyecto_contrapartida WHERE id_proyecto = '".$id_proyecto."'");

        $num_rows = mysql_num_rows($resultado); 
        
        mysql_close(); 
        if($num_rows > 1){
            return true;
        }
        return false;
    }

public function editarValor($id_pru, $valor)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto_contrapartida` SET `valor`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarValorDisponible($id_pru, $valor)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto_contrapartida` SET `valor_disponible`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }


    public function eliminarProyectoRubroPorProyecto($id_proyecto)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM proyecto_contrapartida WHERE id_proyecto='".$id_proyecto."'" );
        
        mysql_close();
        
        return true;
    }  

}


?>
