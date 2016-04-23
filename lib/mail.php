<?php
require_once ( 'class.phpmailer.php');
require_once ( 'class.smtp.php');


   function enviar_mensaje($para,$paraNombre, $asunto, $msg){
	      $mail = new PHPMailer();   
                          
          $mail->IsSMTP();   
          // la dirección del servidor, p. ej.: smtp.servidor.com
          $mail->Host = "smtp.gmail.com";
                        
          $mail->SetFrom('sistemasdeinformacion@ufps.edu.co', 'Sistema de Informacion VAIE');
          $mail->AddReplyTo('sistemasdeinformacion@ufps.edu.co', 'Sistema de Informacion VAIE'); 
                          
          $mail->AddAddress($para, $paraNombre);//destinatario que va a recibir el correo   
          $mail->IsHTML(true);
                          
          $mail->Subject = utf8_decode($asunto);   
 
          $rta='';
          $rta.='<div style="width: 550px; margin: 0 auto;background-color: #fff;border: 1px solid #960e0e;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);overflow: hidden;box-shadow: 0 1px 1px rgba(0,0,0,.05);font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;">';
          $rta.='<div style="border-bottom: 1px solid #ccc;margin: 0px;padding: 5px;text-align: center;background-color: #fff;color: #333;background-color: #f5f5f5;border-color: #e7e7e7;"><img style="height: 95px; max-height: 95px;" height="95" src="../img/banner2.jpg" alt="Logo"></div>';
          $rta.='<div style="min-height: 150px;">';
          $rta.='<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 12px;line-height: 1.42857143;color: #333;padding: 20px 15px;margin: 0;text-align: justify;">';

          $rta.= $msg;

          $rta.='</p>';
          $rta.='</div>';
          $rta.='<div style="text-align: center;padding: 10px 15px;background-color: #f5f5f5;border-top: 1px solid #ddd;border-bottom-right-radius: 3px;border-bottom-left-radius: 3px;">';
          $rta.='<a style="text-decoration: none;color: #960e0e;font-weight: 700;font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;" href="http://ufps.edu.co/ufps/SistemaVaie">Sistema Vaie</a> - ';
          $rta.='<a style="text-decoration: none;color: #960e0e;font-weight: 700;font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;" href="'.BASE_URL.'acerca/">Acerca</a>';
          $rta.='</div>';
          $rta.='</div>';
                                              
          $mail->Body = $body;
                          
          // si el cuerpo del mensaje es HTML
          $mail->MsgHTML($rta);
                         
          // si el SMTP necesita autenticación
          $mail->SMTPAuth = true;

          // Establece el tipo de seguridad SMTP 
          $mail->SMTPSecure = "ssl";   

          // Establece el puerto del servidor SMTP de Gmail
          $mail->Port = 465;                                 

          // credenciales usuario
          $mail->Username = "semanacyt.ufps";
          $mail->Password = "vicerrectoria_2";  

          if(!$mail->Send()) {
            return false;
          } else {
             return true;  
          }
	
} 


?>