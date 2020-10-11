<?php
function send_mail($name, $usermail,$subjeck, $message){
    $status = "";
    error_reporting(E_ALL);
    require 'PHPMailer/src/PHPMailer.php' ;
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    $mail =  new PHPMailer\PHPMailer1\PHPMailer();
    try {
        //Server settings
        // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'rafihanif86@gmail.com';                 // SMTP username
        $mail->Password = 'Glacier86';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('rafihanif86@gmail.com', 'Admin Inventory OPA Ganendra Giri');
        $mail->addAddress($usermail,$name);                   // Add a recipient        

    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subjeck;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if($mail->Send()){
            $status = "berhasil_dikirim";
        }else{
            $status = "gagal_dikirim";
        }
        
    } catch (Exception $e) {
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    return ;
}