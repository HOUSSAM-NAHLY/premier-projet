<?php
// Démarrer la session pour pouvoir mémoriser la connexion de l’administrateur
session_start();

// Définir un mot de passe simple pour l’accès à la page admin
$pass = "1234";

// Vérifier si l’administrateur n’est pas encore connecté
if (!isset($_SESSION['loggedin'])) {
    
    // Vérifier si le formulaire de connexion a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Comparer le mot de passe saisi avec le mot de passe défini plus haut
        if ($_POST['password'] === $pass) {
            
            // Si c’est correct → on crée une session indiquant que l’admin est connecté
            $_SESSION['loggedin'] = true;
            
            // Redirection vers la page admin (actualisation pour voir les commandes)
            header("Location: admin.php");
            exit; // arrêter l’exécution du script ici
        } else {
            // Si le mot de passe est incorrect → afficher un message d’erreur
            echo "Mot de passe incorrect";
        }
    }

    // Formulaire de connexion (HTML affiché seulement si pas encore connecté)
    ?>
    <form method="post" style="margin:100px auto;max-width:300px;text-align:center;">
      <h3>Connexion Admin</h3>
      <input type="password" name="password" placeholder="Mot de passe"><br><br>
      <button type="submit">Entrer</button>
    </form>
    <?php
    exit; // on arrête le script ici si non connecté
}

// Nom du fichier contenant les commandes
$file = "commandes.json";

// Vérifier si le fichier des commandes existe
if (!file_exists($file)) {
    // Si le fichier n’existe pas encore → afficher un message et arrêter le script
    echo "<h2>Aucune commande encore</h2>";
    exit;
}

// Lire le contenu du fichier JSON et le convertir en tableau PHP
$data = json_decode(file_get_contents($file), true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - Commandes</title>
  <style>
    /* Style de la page admin */
    body { font-family: Arial; padding: 20px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 10px; }
    th { background: #007bff; color: white; }
  </style>
</head>
<body>
<h2>📦 Liste des Commandes</h2>

<!-- Tableau affichant les informations des commandes -->
<table>
  <tr>
    <th>Nom</th>
    <th>Adresse</th>
    <th>Téléphone</th>
    <th>Paiement</th>
    <th>Produits</th>
    <th>Date</th>
  </tr>

  <!-- Boucle PHP pour parcourir et afficher chaque commande -->
  <?php foreach($data as $cmd): ?>
  <tr>
    <!-- Sécuriser les affichages avec htmlspecialchars pour éviter les injections -->
    <td><?= htmlspecialchars($cmd['nom']) ?></td>
    <td><?= htmlspecialchars($cmd['adresse']) ?></td>
    <td><?= htmlspecialchars($cmd['telephone']) ?></td>
    <td><?= htmlspecialchars($cmd['paiement']) ?></td>

    <!-- Liste des produits commandés -->
    <td>
      <ul>
        <?php foreach($cmd['produits'] as $p): ?>
          <li><?= $p['quantite'] ?> x <?= htmlspecialchars($p['produit']) ?> (<?= $p['prix'] ?> DH)</li>
        <?php endforeach; ?>
      </ul>
    </td>

    <!-- Date de la commande -->
    <td><?= $cmd['date'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
