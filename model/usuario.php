<?php

/**
 * Description of usuario
 *
 * @author Diana Calderon
 */
class usuario {
  
    public $login;
    public $clave;
    public $nombre;
    public $apellido;
    
     public function __construct() {
        $this->uno=1;
        
        }
    
    public function iniciarSesion($nombre, $clav)
    {
        
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM  `usuario` WHERE  `login` LIKE  '".$nombre."' AND  `clave` LIKE  '".$clav."' LIMIT 0 , 30");
    
        $usuarios = array();
 
        while($usuario = mysql_fetch_assoc($resultado))
        {   $usuarios[] = $usuario;}
        
        mysql_close();
        
        if(sizeof($usuarios, null)>0){
            return true;
            die();
        }
        return false;
    }
     
    public function buscarSesion($nombre, $clav)
    {
        
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM  `usuario` WHERE  `login` LIKE  '".$nombre."' AND  `clave` LIKE  '".$clav."' LIMIT 0 , 30");
    
        $usuarios = array();
 
        while($usuario = mysql_fetch_assoc($resultado))
        {   $usuarios[] = $usuario;}
        
        mysql_close();
        
        return $usuarios;
    }
    
    

    public function agregarUsuario($usuario)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `usuario` (`login`, `clave`, `nombre`, `apellido`, `rol`,`codigo_verificacion`, `verificado`) 
                     VALUES ('".$usuario[0]."', '".$usuario[1]."', '".$usuario[2]."', '".$usuario[3]."', 
                        '".$usuario[4]."', '".$usuario[5]."', '".$usuario[6]."');");
        
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }

   
    public function buscarUsuario($codigo)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM usuario WHERE codigo_verificacion="'.$codigo.'"');
        $usuarios= array();
         
        while($usuario = mysql_fetch_assoc($resultado))
        {  $usuarios[] = $usuario;}
                
        mysql_close();   
 
        return $usuarios[0];
    }
    
    public function buscarUsuarioIdPersona($id_persona)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM usuario WHERE id_persona='.$id_persona);
        $usuarios= array();
         
        while($usuario = mysql_fetch_assoc($resultado))
        {  $usuarios[] = $usuario;}
              
        mysql_close();   
 
        return $usuarios;
    }
    
    public function verificadoUsuarioIdPersona($id_persona)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM usuario WHERE id_persona='.$id_persona.' && verificado=1 ');
        
        $usuarios = array();
 
        while($usuario = mysql_fetch_assoc($resultado))
        {   $usuarios[] = $usuario;}
        
        mysql_close();
        
        if(sizeof($usuarios, null)>0){
            return true;
            die();
        }
        return false;
    }

    public function verificado($id_usuario)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `usuario` SET `verificado`='1' WHERE `id_usuario` = '".$id_usuario."' ;");
        
        mysql_close();
        
        return true;    
    }
    
    public function verificarUsuarioIdPersona($id, $verificar)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("UPDATE `usuario` SET `verificado`='".$verificar."' WHERE `id_persona` = '".$id."';");
        
        
        mysql_close();
        
        return $resultado;
    }
    
    public function agregarUsuarioIdPersona($usuario)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `usuario` (`login`, `clave`, `nombre`, `apellido`, `rol`,`codigo_verificacion`, `verificado`, `id_persona` ) 
                     VALUES ('".$usuario[0]."', '".$usuario[1]."', '".$usuario[2]."', '".$usuario[3]."', 
                        '".$usuario[4]."', '".$usuario[5]."', '".$usuario[6]."', '".$usuario[7]."');");
        
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    
}

?>
