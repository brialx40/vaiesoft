<?php


/**
 * Description of propuesta_rubro
 *
 * @author Diana Calderon
 */
class PropuestaRubro {
    
    public $id_propuesta;
    public $id_contrapartida;
    public $valor;

    public function __construct() {

    }
 
    
public function agregarPropuestaRubro($propuesta_rubro)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `propuesta_rubro` (`id_propuesta`, `id_contrapartida`, `valor`) VALUES ('".$propuesta_rubro[0]."', '".$propuesta_rubro[1]."', '".$propuesta_rubro[2]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 

  public function editarPropuestaRubro($id_propuesta, $nuevoRubro)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta_rubro` SET  `id_propuesta` =  '".$nuevoRubro[0]."', `id_contrapartida` =  '".$nuevoRubro[1]."', `valor` =  '".$nuevoRubro[2]."' WHERE `id_pru` =  '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
      
    }

     public function eliminarPropuestaRubro($id_pru)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM propuesta_rubro WHERE id_pru='".$id_pru."'" );
        
        mysql_close();
        
        return true;
    }  
    
public function buscarRubrosPorPropuesta($id_propuesta)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM propuesta_rubro WHERE id_propuesta = '".$id_propuesta."'");
        $rubros= array();
    
        while($rubro = mysql_fetch_row($resultado))
        {   $rubros[] = $rubro;}

        mysql_close(); 
        
       return $rubros[0];         
     
    }

    public function buscarPropuestaRubro($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM propuesta_rubro WHERE id_pru='.$id);
        $rubros= array();
         
        while($rubro = mysql_fetch_assoc($resultado))
        {  $rubros[] = $rubro;}
                        
        mysql_close();   
 
        return $rubros[0];
    } 

    public function listaRubrosPorPropuesta($id_propuesta)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `propuesta_rubro` WHERE id_propuesta = '".$id_propuesta."'");
        $rubros= array();
 
        while($rubro = mysql_fetch_assoc($resultado)){  
            $rubros[] = $rubro;
        }
               
        mysql_close();   
 
        return $rubros;
    }
    
public function getValorInicial($id_propuesta, $id_pru)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT  valor FROM propuesta_rubro WHERE id_pru=".$id_pru);
        $valorini= array();
    
        while($valor = mysql_fetch_row($resultado))
        {   $valorini[] = $valor;}
                
        
        //$rubros= mysql_fetch_row($resultado);               
        mysql_close(); 
        return $valorini[0];
    }
    
    
    
 public function UpdateProyectoRubro($id_propuesta, $id_pru, $valorInicial)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  propuesta_rubro SET  valor =  '".$valorInicial."' WHERE id_propuesta LIKE  '".$id_propuesta."' AND  id_pru=".$id_pru);
        
        mysql_close();
        
        if($resultado==1)
            return true;
        return false;
    }

public function ExistenRubrosPorPropuesta($id_propuesta)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM propuesta_rubro WHERE id_propuesta = '".$id_propuesta."'");

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
      
        $resultado = mysql_query("UPDATE  `propuesta_rubro` SET `valor`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarValorDisponible($id_pru, $valor)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta_rubro` SET `valor_disponible`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }


    public function eliminarProyectoRubroPorProyecto($id_propuesta)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM propuesta_rubro WHERE id_propuesta='".$id_propuesta."'" );
        
        mysql_close();
        
        return true;
    }  

}


?>
