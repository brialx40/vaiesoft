<?php


/**
 * Description of proyecto_rubro
 *
 * @author Diana Calderon
 */
class ProyectoRubro {
    
    public $id_proyecto;
    public $id_contrapartida;
    public $valor;

    public function __construct() {

    }
 
    
public function agregarProyectoRubro($proyecto_rubro)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `proyecto_rubro` (`id_proyecto`, `id_contrapartida`, `valor` , `valor_disponible`) VALUES ('".$proyecto_rubro[0]."', '".$proyecto_rubro[1]."', '".$proyecto_rubro[2]."', '".$proyecto_rubro[2]."');");
                
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 

  public function editarProyectoRubro($id_proyecto, $nuevoRubro)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto_rubro` SET  `id_proyecto` =  '".$nuevoRubro[0]."', `id_contrapartida` =  '".$nuevoRubro[1]."', `valor` =  '".$nuevoRubro[2]."', `valor_disponible` =  '".$nuevoRubro[2]."' WHERE `id_pru` =  '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
      
    }

     public function eliminarProyectoRubro($id_pru)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM proyecto_rubro WHERE id_pru='".$id_pru."'" );
        
        mysql_close();
        
        return true;
    }  
    
public function buscarRubrosPorProyecto($id_proyecto)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM proyecto_rubro WHERE id_proyecto = '".$id_proyecto."'");
        $rubros= array();
    
        while($rubro = mysql_fetch_row($resultado))
        {   $rubros[] = $rubro;}

        mysql_close(); 
        
       return $rubros[0];         
     
    }

    public function buscarProyectoRubro($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM proyecto_rubro WHERE id_pru='.$id);
        $rubros= array();
         
        while($rubro = mysql_fetch_assoc($resultado))
        {  $rubros[] = $rubro;}
                        
        mysql_close();   
 
        return $rubros[0];
    } 

    public function listaRubrosPorProyecto($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `proyecto_rubro` WHERE id_proyecto = '".$id_proyecto."'");
        $rubros= array();
 
        while($rubro = mysql_fetch_assoc($resultado)){  
            $rubros[] = $rubro;
        }
               
        mysql_close();   
 
        return $rubros;
    }
    
public function getValorInicial($id_proyecto, $id_pru)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT  valor FROM proyecto_rubro WHERE id_pru=".$id_pru);
        $valorini= array();
    
        while($valor = mysql_fetch_row($resultado))
        {   $valorini[] = $valor;}
                
        
        //$rubros= mysql_fetch_row($resultado);               
        mysql_close(); 
        return $valorini[0];
    }
    
    
    
 public function UpdateProyectoRubro($id_proyecto, $id_pru, $valorInicial)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  proyecto_rubro SET  valorInicial =  '".$valorInicial."' WHERE id_proyecto LIKE  '".$id_proyecto."' AND  id_pru=".$id_pru);
        
        mysql_close();
        
        if($resultado==1)
            return true;
        return false;
    }

public function ExistenRubrosPorProyecto($id_proyecto)
    {
        include 'conectar.php';
                
        $resultado = mysql_query("SELECT * FROM proyecto_rubro WHERE id_proyecto = '".$id_proyecto."'");

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
      
        $resultado = mysql_query("UPDATE  `proyecto_rubro` SET `valor`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarValorDisponible($id_pru, $valor)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto_rubro` SET `valor_disponible`='".$valor."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarValores($id_pru, $valor, $valor_disponible)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE `proyecto_rubro` SET `valor`='".$valor."', `valor_disponible`='".$valor_disponible."' WHERE `id_pru` = '".$id_pru."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function eliminarProyectoRubroPorProyecto($id_proyecto)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM proyecto_rubro WHERE id_proyecto='".$id_proyecto."'" );
        
        mysql_close();
        
        return true;
    }  

}


?>
