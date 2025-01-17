<?php
// Inclure le fichier d'authentification
require_once('auth.php');

// Vérification de l'authentification et des droits d'administrateur
check_admin();

// Inclure le fichier de connexion à la base de données
require_once __DIR__ . '/app/config/Database.php';


// Récupérer la liste des pièces jointes à partir de la base de données
$query = "SELECT * FROM pieces_jointes"; // Exemple de requête pour récupérer toutes les pièces jointes
$stmt = $pdo->query($query);
$pieces_jointes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Supprimer une pièce jointe si une requête de suppression a été envoyée
if (isset($_POST['delete_piece_jointe'])) {
    $piece_id = $_POST['piece_id'];
    $delete_query = "DELETE FROM pieces_jointes WHERE Piece_jointe_id = :piece_id";
    $stmt_delete = $pdo->prepare($delete_query);
    $stmt_delete->bindParam(':piece_id', $piece_id, PDO::PARAM_INT);
    $stmt_delete->execute();
    header("Location: gestion_pieces_jointes.php"); // Recharger la page après suppression
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Pièces Jointes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

    <h1>Gestion des Pièces Jointes</h1>

    <h2>Liste des Pièces Jointes</h2>
    <!-- Table des pièces jointes -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du fichier</th>
                <th>Type de fichier</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher chaque pièce jointe
            foreach ($pieces_jointes as $piece) {
                echo "<tr>";
                echo "<td>" . $piece['Piece_jointe_id'] . "</td>";
                echo "<td>" . $piece['Nom_fichier'] . "</td>";
                echo "<td>" . $piece['Type_fichier'] . "</td>";
                echo "<td>" . $piece['Date_ajout'] . "</td>";
                echo "<td>
                        <!-- Formulaire pour supprimer une pièce jointe -->
                        <form method='POST' style='display:inline;' action='gestion_pieces_jointes.php'>
                            <input type='hidden' name='piece_id' value='" . $piece['Piece_jointe_id'] . "'>
                            <button type='submit' name='delete_piece_jointe' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette pièce jointe ?\");'>Supprimer</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
