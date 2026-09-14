<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
}

$name    = htmlspecialchars(trim($_POST['name'] ?? ''));
$email   = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

if (empty($name) || empty($email) || empty($message)) {
    echo "Vul alle verplichte velden in.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Ongeldig e-mailadres.";
    exit;
}

try {
    $mail = new PHPMailer(true);

    // ========== SMTP-instellingen ==========
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'Tygostaalsmid@gmail.com';          // ← Vervang door jouw Gmail
    $mail->Password   = 'quem qvbx kixs eyqa';           // ← Vervang door App-wachtwoord
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Debug (tijdelijk aanzetten als het niet werkt)
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->setFrom('Tygostaalsmid@gmail.com', 'PB Promotions Website');
    $mail->addAddress('Tygostaalsmid@gmail.com', 'PB Promotions');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(false);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = "Nieuw bericht van $name";
    $mail->Body    = "Je hebt een nieuw bericht ontvangen via het contactformulier:\n\n"
                   . "Naam: $name\n"
                   . "E-mail: $email\n"
                   . "Telefoon: $phone\n\n"
                   . "Bericht:\n$message\n";

    $mail->send();

    header("Location: bedankt.html");
    exit;

} catch (Exception $e) {
    echo "Er is iets misgegaan bij het versturen.<br>";
    echo "Foutmelding: " . htmlspecialchars($mail->ErrorInfo);
}
?>