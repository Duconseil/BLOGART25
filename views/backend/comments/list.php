<?php
include '../../../header.php';

// Charger les commentaires depuis la base de données
$commentsAttente = sql_select("comment", "*", "dtModCom IS NULL");
$commentsControle = sql_select("comment", "*", "dtModCom IS NOT NULL AND dellogiq = 0");
$commentsArchive = sql_select("comment", "*", "dtModCom IS NOT NULL AND dellogiq = 1");

// Fonction pour récupérer les informations de membre
function getMembre($numMemb) {
    return sql_select("membre", "*", "numMemb = $numMemb")[0];
}

// Fonction pour récupérer les informations d'article
function getArticle($numArt) {
    return sql_select("article", "*", "numArt = $numArt")[0];
}
?>

<!-- Contenu principal -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Commentaires</h1>

            <!-- Lien pour créer un commentaire -->
            <br>
                <a href="create.php" class="btn-success-custom">Create</a>
            <br>
            <br>
            <br>

            <!-- Commentaires en attente de contrôle -->
            <h2>Commentaires en attente</h2>
            <table class="table table-striped comment-table">
                <thead>
                    <tr>
                        <th>Titre Article</th>
                        <th>Pseudo</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commentsAttente as $comment) : 
                        $article = getArticle($comment['numArt']);
                        $membre = getMembre($comment['numMemb']);
                    ?>
                        <tr>
                            <td><?= $article['libTitrArt']; ?></td>
                            <td><?= $membre['pseudoMemb']; ?></td>
                            <td><?= $comment['dtCreaCom']; ?></td>
                            <td><?= $comment['libCom']; ?></td>
                            <td>
                                <a href="controle.php?numCom=<?= $comment['numCom']; ?>" class="btn-warning-custom">Control</a>
                                <a href="edit.php?numCom=<?= $comment['numCom']; ?>" class="btn-primary-custom">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

            <!-- Commentaires contrôlés -->
            <h2>Commentaires contrôlés</h2>
            <table class="table table-striped comment-table">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Dernière modif</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison Refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commentsControle as $comment) :
                        $membre = getMembre($comment['numMemb']);
                    ?>
                        <tr>
                            <td><?= $membre['pseudoMemb']; ?></td>
                            <td><?= $comment['dtModCom']; ?></td>
                            <td><?= $comment['libCom']; ?></td>
                            <td><?= $comment['attModOK'] == 1 ? "OUI" : "NON"; ?></td>
                            <td><?= $comment['notifComKOAff']; ?></td>
                            <td>
                                <a href="edit.php?numCom=<?= $comment['numCom']; ?>" class="btn-primary-custom">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>


            <!-- Commentaires archivés (Suppression logique) -->
            <h2>Suppression logique</h2>
            <table class="table table-striped comment-table">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date suppr logique</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commentsArchive as $comment) : 
                        $membre = getMembre($comment['numMemb']);
                    ?>
                        <tr>
                            <td><?= $membre['pseudoMemb']; ?></td>
                            <td><?= $comment['dtDelLogCom']; ?></td>
                            <td><?= $comment['libCom']; ?></td>
                            <td><?= $comment['attModOK'] == 1 ? "OUI" : "NON"; ?></td>
                            <td><?= $comment['notifComKOAff']; ?></td>
                            <td>
                                <a href="edit.php?numCom=<?= $comment['numCom']; ?>" class="btn-primary-custom">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>


            <!-- Commentaires archivés (Suppression physique) -->
            <h2>Suppression physique</h2>
            <table class="table table-striped comment-table">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date suppr logique</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commentsArchive as $comment) : 
                        $membre = getMembre($comment['numMemb']);
                    ?>
                        <tr>
                            <td><?= $membre['pseudoMemb']; ?></td>
                            <td><?= $comment['dtDelLogCom']; ?></td>
                            <td><?= $comment['libCom']; ?></td>
                            <td><?= $comment['attModOK'] == 1 ? "OUI" : "NON"; ?></td>
                            <td><?= $comment['notifComKOAff']; ?></td>
                            <td>
                                <a href="delete.php?numCom=<?= $comment['numCom']; ?>" class="btn-danger-custom">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <br>
            <br>

        </div>
    </div>
</div>

<!-- CSS pour personnaliser les boutons et l'apparence -->
<style>
    body {
        background-color: #f4f4f9;
        font-family: Arial, sans-serif;
    }

    .container {
        margin-top: 20px;
    }

    h1 {
        color: #333;
    }

    h2 {
        color: #555;
    }

    .table th, .table td {
        text-align: center;
    }

    .btn-warning-custom {
        background-color: #f0ad4e;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-warning-custom:hover {
        background-color: #ec971f;
        color: white; /* Texte blanc au survol */
    }

    .btn-primary-custom {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-primary-custom:hover {
        background-color: #0056b3;
        color: white; /* Texte blanc au survol */
    }

    .btn-danger-custom {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-danger-custom:hover {
        background-color: #c82333;
        color: white; /* Texte blanc au survol */
    }

    .btn-success-custom {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-success-custom:hover {
        background-color: #218838;
        color: white; /* Texte blanc au survol */
    }

    .comment-table th, .comment-table td {
        text-align: left;
    }
</style>

<?php include '../../../footer.php'; ?>
