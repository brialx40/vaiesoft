<?php

/**
 * Description of cerrarsesion
 *
 * @author Diana Calderon
 */
@session_start();

session_destroy();

echo "<script language=Javascript> location.href=\"../index.php\"; </script>";  
   
die();

?>
