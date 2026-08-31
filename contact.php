<?php
// Alleen POST-aanvragen toestaan
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
}

// Gegevens ophalen en opschonen
$name    = htmlspecialchars(trim($_POST['name'] ?? ''));
$email   = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

// Validatie
if (empty($name) || empty($email) || empty($message)) {
    echo "Vul alle verplichte velden in.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Ongeldig e-mailadres.";
    exit;
}

// E-mailadres van PB Promotions
$to = "Tygostaalsmid@gmail.com";

$subject = "Nieuw bericht via de website van $name";
$body = "Je hebt een nieuw bericht ontvangen via het contactformulier op de website:\n\n"
      . "Naam: $name\n"
      . "E-mail: $email\n"
      . "Telefoon: $phone\n\n"
      . "Bericht:\n$message\n";

$headers = "From: $email\r\n"
         . "Reply-To: $email\r\n"
         . "Content-Type: text/plain; charset=UTF-8\r\n";

// Verstuur de e-mail
if (mail($to, $subject, $body, $headers)) {
    // Succes – stuur door naar bedankpagina
    header("Location: bedankt.html");
    exit;
} else {
    echo "Er is iets misgegaan bij het versturen. Probeer het later opnieuw of bel ons.";
}
?>