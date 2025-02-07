<?php
include '../../../header.php'; // Contient le header et l'appel à config.php

// Récupérer tous les membres et les likes
$membres = sql_select("membre", "*");
$likes = sql_select("likeart", "*");

if (isset($_GET['numMemb'])) {
    $numMemb = intval($_GET['numMemb']); // Sécuriser l'entrée
    $result = sql_select("membre", "pseudoMemb", "numMemb = $numMemb");
    if (!empty($result)) {
        $pseudoMemb = $result[0]['pseudoMemb'];
    } else {
        $pseudoMemb = "Inconnu"; // Si aucun membre trouvé
    }
}
?>

<!-- Inclusion du CSS -->
<link rel="stylesheet" href="/../../src/css/style.css">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des likes</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo Membre</th>
                        <th>ID Article</th>
                        <th>Type de Like</th> <!-- Nouvelle colonne pour afficher le type de like -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($likes as $like) { 
                        // Récupérer le pseudo du membre
                        $numMemb = intval($like['numMemb']);
                        $membreData = sql_select("membre", "pseudoMemb", "numMemb = $numMemb");
                        $pseudoMemb = !empty($membreData) ? $membreData[0]['pseudoMemb'] : "Inconnu";
                        
                        // Vérification de la valeur de likeA pour afficher "Like" ou "Dislike"
                        $typeLike = $like['likeA'] == 1 ? 'Like' : 'Dislike'; 
                    ?>
                        <tr>
                            <td><?php echo ($pseudoMemb); ?></td>
                            <td><?php echo ($like['numArt']); ?></td>
                            <td><?php echo ($typeLike); ?></td> <!-- Affichage du type de like -->
                            <td>
                                <a href="edit.php?numArt=<?php echo ($like['numArt']); ?>&numMemb=<?php echo ($like['numMemb']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?php echo ($like['numArt']); ?>&numMemb=<?php echo ($like['numMemb']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>