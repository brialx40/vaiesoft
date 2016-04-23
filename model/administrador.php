<?php

/**
 * Description of administrador
 *
 * @author Diana Calderon
 */
class administrador {
  
    public $loginAdmin;
    public $claveAdmin;
    public $nombre;
    public $apellido;
    
     public function __construct() {
        $this->uno=1;
        
        }
    
    public function iniciarSesion($nombre, $clav)
    {
        
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM  `administrador` WHERE  `loginAdmin` LIKE  '".$nombre."' AND  `claveAdmin` LIKE  '".$clav."' LIMIT 0 , 30");
    
        $administradores = array();
 
        while($administrador = mysql_fetch_assoc($resultado))
        {   $administradores[] = $administrador;}
        
        mysql_close();
        
        if(sizeof($administradores, null)>0){
            return true;
            die();
        }
        return false;
    }
     
    public function buscarSesion($nombre, $clav)
    {
        
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM  `administrador` WHERE  `loginAdmin` LIKE  '".$nombre."' AND  `claveAdmin` LIKE  '".$clav."' LIMIT 0 , 30");
    
        $administradores = array();
 
        while($administrador = mysql_fetch_assoc($resultado))
        {   $administradores[] = $administrador;}
        
        mysql_close();
        
        return $administradores;
    }
}

?>
