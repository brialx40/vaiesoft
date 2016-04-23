<?php


/**
 * Description of propuesta_contrapartida
 *
 * @author Diana Calderon
 */
class PropuestaContrapartida {
    
    public $id_propuesta;
    public $valor;

    public function __construct() {

    }
 
    
public function agregarPropuestaContrapartida($propuesta_contrapartida)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `propuesta_contrapartida` (`id_propuesta`, `nombre`, `valor`, `total`) VALUES ('".$propuesta_contrapartida[0]."', '".$propuesta_contrapartida[1]."', '".$propuesta_contrapartida[2]."', '".$propuesta_contrapartida[3]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 

  public function editarPropuestaContrapartida($id_pru, $nuevaContrapartida)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta_contrapartida` SET  `nombre` =  '".$nuevaContrapartida[1]."', `valor` =  '".$nuevaContrapartida[2]."', `total` =  '".$nuevaContrapartida[3]."' WHERE `id_pru` =  '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
      
    }

     public function eliminarPropuestaContrapartida($id_pru)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM propuesta_contrapartida WHERE id_pru='".$id_pru."'" );
        
        mysql_close();
        
        return true;
    }  
    
public function buscarContrapartidaPorPropuesta($id_propuesta)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM propuesta_contrapartida WHERE id_propuesta = '".$id_propuesta."'");
        $contrapartidas= array();
    
        while($contrapartida = mysql_fetch_row($resultado))
        {   $contrapartidas[] = $contrapartida;}

        mysql_close(); 
        
       return $contrapartidas[0];         
     
    }

    public function buscarPropuestaContrapartida($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM propuesta_contrapartida WHERE id_pru='.$id);
        $contrapartidas= array();
         
        while($contrapartida = mysql_fetch_assoc($resultado))
        {  $contrapartidas[] = $contrapartida;}
                        
        mysql_close();   
 
        return $contrapartidas[0];
    } 

    public function listaContrapartidaPorPropuesta($id_propuesta)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `propuesta_contrapartida` WHERE id_propuesta = '".$id_propuesta."'");
        $contrapartidas= array();
 
        while($contrapartida = mysql_fetch_assoc($resultado)){  
            $contrapartidas[] = $contrapartida;
        }
               
        mysql_close();   
 
        return $contrapartidas;
    }
    
    
 public function UpdateProyectoRubro($id_propuesta, $id_pru, $valorInicial)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  propuesta_contrapartida SET  valor =  '".$valorInicial."' WHERE id_propuesta LIKE  '".$id_propuesta."' AND  id_pru=".$id_pru);
        
        mysql_close();
        
        if($resultado==1)
            return true;
        return false;
    }

public function ExistenRubrosPorPropuesta($id_propuesta)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM propuesta_contrapartida WHERE id_propuesta = '".$id_propuesta."'");

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
      
        $resultado = mysql_query("UPDATE  `propuesta_contrapartida` SET `valor`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarValorDisponible($id_pru, $valor)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta_contrapartida` SET `valor_disponible`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }


    public function eliminarProyectoRubroPorProyecto($id_propuesta)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM propuesta_contrapartida WHERE id_propuesta='".$id_propuesta."'" );
        
        mysql_close();
        
        return true;
    }  

}


?>
