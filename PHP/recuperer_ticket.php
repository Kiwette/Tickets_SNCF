<?php
// Configuration de la connexion à la base de données
$host = 'localhost';     // Hôte de la base de données
$dbname = 'sncf_ticketing';   // Nom de la base de données
$username = 'root';      // Nom d'utilisateur pour la base de données
$password = '';          // Mot de passe de l'utilisateur (laisser vide pour localhost)

// Créer une connexion avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Gestion des erreurs
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête SQL pour récupérer tous les tickets
$query = "SELECT * FROM table_ticket"; 
$stmt = $pdo->prepare($query);
$stmt->execute();

// Récupérer tous les résultats
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retourner les tickets en JSON
header('Content-Type: application/json');
echo json_encode($tickets);
?>
