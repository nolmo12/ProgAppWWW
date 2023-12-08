<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $message = $_POST['content'];
    $name = $_POST['firstname'];
    $country = $_POST['country'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $message = "Wrong E-mail";
    }
    else
    {
            $final_message = "Dziękuje za kontakt, $name. Odezwę się najszybciej jak tylko będę mógł!</br>Z wyrazami szacunku: <i>Nolmo</i>";
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com;';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = '4rightpon7@gmail.com';                 
            $mail->Password   = 'afjs pnwh qyyh lhnp';                        
            $mail->SMTPSecure = 'tls';                              
            $mail->Port       = 587;  
            $mail->CharSet = "UTF-8";
            $mail->setFrom('4rightpon7@gmail.com');           
            $mail->addAddress($email, $name);
               
            $mail->IsHTML(true);
            $mail->SetFrom("4rightpon7@gmail.com", "no-reply");
            $mail->Subject = "Dziękuje za kontakt!";
            $mail->MsgHTML($final_message);
            if(!$mail->Send()) {
              echo "Error while sending Email.";
              var_dump($mail);
            } else {
              echo "Email sent successfully";
            }
            $mail->ClearAllRecipients();

            $final_message = "<p>E-Mail: $email</p><p>Imię: $name</p><p>Kraj: $country</p><p>Treść: $message";
            $mail->setFrom('4rightpon7@gmail.com');           
            $mail->addAddress('4rightpon7@gmail.com');
            $mail->IsHTML(true);
            $mail->SetFrom("4rightpon7@gmail.com", "no-reply");
            $mail->Subject = "Wiadomość z blogu od: $email";
            $mail->MsgHTML($final_message);
            if(!$mail->Send()) {
              echo "Error while sending Email.";
              var_dump($mail);
            } else {
              echo "Email sent successfully";
            }
            header('Location: index.php');
        }

        
    }

?>