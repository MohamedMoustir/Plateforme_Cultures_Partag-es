<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require '../vendor/autoload.php';

// $mail = new PHPMailer(true);

// try {
//     $mail->isSMTP();                                            
//     $mail->Host       = 'smtp.gmail.com';                       
//     $mail->SMTPAuth   = true;                                   
//     $mail->Username   = 'itsmoustir@gmail.com';                
//     $mail->Password   = 'bqct sreu xpzd agvy';          
//     $mail->Port = 587; 
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                

//     $mail->setFrom('itsmoustir@gmail.com', 'Mohamed Moustir'); 
//     $mail->addAddress('flashhashim37@gmail.com', 'Recipient'); 

//     $mail->isHTML(true);                                       
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the plain text version of the email content';

//     $mail->send();
//     echo 'Message has been sent successfully!';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }


// ob_end_clean();



// require_once '../fpdf\fpdf.php';
// $pdf = new FPDF();


// $pdf->AddPage();

// $pdf->SetFont('Arial', 'B', 18);


// $pdf->Cell(60,20,'Hello GeeksforGeeks!');

// $pdf->Output();

