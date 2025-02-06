<?php
include '../../../header.php'; // contains the header and call to config.php

// Charger les commentaires depuis la base de données
$comments = sql_select("comment", "*");
$articles = sql_select("article", attributs: "*");
$membres = sql_select("membre", "*");

function getMembre($numMemb) {
    return sql_select("membre", "*", "numMemb = $numMemb")[0];
}

function getArticle($numArt) {
    return sql_select("article", "*", "numArt = $numArt")[0];
}

// Filter comments by status
$commentsAttente = sql_select("comment", "*","dtModCom IS null");
$commentsControle = sql_select("comment","*","dtModCom IS NOT null AND dellogiq=0");
$commentsArchive = sql_select("comment","*","dtModCom IS NOT null AND dellogiq=1");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Commentaires</h1>
            <br>
            <a href="create.php" class="btn-success-custom">Create</a>
            <br>
            <br>

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
                                <!-- Lien pour le contrôle -->
                                <a href="controle.php?numCom=<?= urlencode($comment['numCom']); ?>" class="btn-warning-custom">Control</a>
                                <!-- Lien pour l'édition -->
                                <a href="edit-attente-validation.php?numCom=<?= urlencode($comment['numCom']); ?>" class="btn-primary-custom">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

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
                                <!-- Lien pour l'édition -->
                                <a href="edit-controle-modification.php?numCom=<?= urlencode($comment['numCom']); ?>" class="btn-primary-custom">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

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
                                <!-- Lien pour l'édition -->
                                <a href="edit-suppression.php?numCom=<?= urlencode($comment['numCom']); ?>" class="btn-primary-custom">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

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
                                <!-- Lien pour la suppression physique -->
                                <a href="delete.php?numCom=<?= urlencode($comment['numCom']); ?>" class="btn-danger-custom">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

        </div>
    </div>
</div>

<style>
    /* Include all the CSS from your provided style tag for customization */
    .btn-warning-custom {
        background-color: #f0ad4e;
        color: white !important;  /* Ensure text stays white */
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .btn-warning-custom:hover {
        background-color: #ec971f;
    }
    .btn-primary-custom {
        background-color: #007bff;
        color: white !important;  /* Ensure text stays white */
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .btn-primary-custom:hover {
        background-color: #0056b3;
    }
    .btn-danger-custom {
        background-color: #dc3545;
        color: white !important;  /* Ensure text stays white */
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .btn-danger-custom:hover {
        background-color: #c82333;
    }
    .btn-success-custom {
        background-color: #28a745;
        color: white !important;  /* Ensure text stays white */
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .btn-success-custom:hover {
        background-color: #218838;
    }
    .comment-table th, .comment-table td {
        text-align: left;
    }
</style>

<?php include '../../../footer.php'; ?>
