<?php
require 'config.php';

// تحقق بالمفتاح
if (($_GET['key'] ?? '') !== ADMIN_KEY) {
    die("🚫 Accès refusé");
}

if (!file_exists(USER_STORAGE)) {
    echo "⚠️ Aucun utilisateur enregistré.";
    exit;
}

$lines = file(USER_STORAGE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

echo "<h2>📋 Liste des utilisateurs (admin)</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Date</th></tr>";
foreach ($lines as $ln) {
    $row = json_decode($ln, true);
    if (!$row) continue;
    echo "<tr>";
    echo "<td>".htmlspecialchars($row['id'])."</td>";
    echo "<td>".htmlspecialchars($row['username'])."</td>";
    echo "<td>".htmlspecialchars($row['email'])."</td>";
    echo "<td>".htmlspecialchars($row['created_at'])."</td>";
    echo "</tr>";
}
echo "</table>";
