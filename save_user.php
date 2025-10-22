<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    if ($username && $email && $password) {
        if ($password !== $confirm) {
            die("⚠️ Les mots de passe ne correspondent pas <br><a href='.html'>Retour</a>");
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $user = [
            'id' => uniqid(),
            'username' => $username,
            'email' => $email,
            'password' => $hashed,
            'created_at' => date('c')
        ];

        if (save_user($user)) {
            
            echo "✅ <h1>Compte créé avec succès</h1> <br><a href='index.html'>⬅️ Retour</a>";
        } else {
            echo "❌ Erreur lors de l'enregistrement";
        }
    } else {
        echo "⚠️ Tous les champs sont obligatoires";
    }
}

