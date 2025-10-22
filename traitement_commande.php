<?php
// Nom du fichier où seront enregistrées les commandes
$file = "commandes.json";

// Récupération des données envoyées depuis le formulaire (méthode POST)
$name = $_POST['name'];        // Nom du client
$address = $_POST['address'];  // Adresse du client
$phone = $_POST['phone'];      // Numéro de téléphone
$payment = $_POST['payment'];  // Méthode de paiement choisie
$cart = json_decode($_POST['cart'], true); // Contenu du panier converti depuis JSON vers un tableau PHP

// Création d’un tableau associatif représentant une commande complète
$commande = [
    "nom" => $name,
    "adresse" => $address,
    "telephone" => $phone,
    "paiement" => $payment,
    "produits" => $cart,
    "date" => date("Y-m-d H:i:s") // Date et heure de la commande
];

// Vérifier si le fichier existe déjà
if (file_exists($file)) {
    // Si oui, on lit son contenu et on le convertit en tableau PHP
    $data = json_decode(file_get_contents($file), true);
} else {
    // Sinon, on crée un tableau vide (première commande)
    $data = [];
}

// Ajouter la nouvelle commande au tableau existant
$data[] = $commande;

// Enregistrer le tableau complet (anciennes + nouvelle commande) dans le fichier JSON
file_put_contents(
    $file, 
    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) // JSON formaté et compatible avec les caractères non latins
);

// Message de confirmation pour le client
echo "<h2>Merci $name ! Votre commande a été enregistrée.</h2>";
echo "<a href='commandes.html'>⬅ Retour</a>";
?>
