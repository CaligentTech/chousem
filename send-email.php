<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// Load the config file strictly from OUTSIDE the public folder
$configPath = dirname(__DIR__) . '/chouse-mail.php';

if (!file_exists($configPath)) {
    error_log("SMTP Configuration file missing at: " . $configPath);
    http_response_code(500);
    exit('Server configuration error.');
}

$config = require $configPath;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize input fields
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $service = htmlspecialchars($_POST['service'] ?? '');
    
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            
        $mail->Host       = $config['smtp_host'];                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = $config['smtp_username'];                     
        $mail->Password   = $config['smtp_password'];                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = $config['smtp_port'];                                    

        // Recipients
        $mail->setFrom('hello@chouse.ae', 'C HOUSE Website Form');
        $mail->addAddress('hello@chouse.ae', 'C HOUSE Admin');     
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'New Contact Form Submission - ' . $name;
        
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Service Requested:</strong> {$service}</p>
        ";
        
        $mail->AltBody = "New Contact Form Submission\n\nName: {$name}\nEmail: {$email}\nPhone: {$phone}\nService: {$service}";

        $mail->send();
        
        header("Location: contact.html?status=success");
        exit();
        
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        header("Location: contact.html?status=error");
        exit();
    }
} else {
    header("Location: contact.html");
    exit();
}
?>
