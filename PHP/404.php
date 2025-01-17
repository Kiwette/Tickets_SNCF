<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas authentifié, vous pouvez afficher un message ou rediriger vers une autre page
    // Par exemple, vous pouvez rediriger vers la page de connexion :
    header("Location: /connexion.php"); // ou toute autre page que vous souhaitez
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - SNCF Ticketing</title>
    <link rel="stylesheet" href="/public/CSS/404_php.css">
</head>

<body>
    <div class="container">
        <h1>404</h1>
        <p>Oups, la page que vous cherchez n'existe pas.</p>
        <p>Il se peut que l'URL soit incorrecte ou que la page ait été supprimée.</p>
        <a href="/public/HTML/Page_accueil.html">Retour à l'accueil</a>
    </div>
</body>

</html>
