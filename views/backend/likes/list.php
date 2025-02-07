<?php
include '../../../header.php';

$likes = sql_select("likeart", "*");
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des likes</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Titre Article</th>
                        <th>Chapeau Article</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($likes as $like) : ?>
                        <?php
                        $membre = sql_select("MEMBRE", "*", "numMemb = {$like['numMemb']}")[0];
                        $article = sql_select("ARTICLE", "*", "numArt = {$like['numArt']}")[0];
                        ?>
                        <tr>
                            <td><?= $membre['pseudoMemb']; ?> (<?= $membre['numMemb']; ?>)</td>
                            <td><?= $article['libTitrArt']; ?></td>
                            <td><?= substr($article['libChapoArt'], 0, 100); ?>...</td>
                            <td><?= $like['numMemb'] == 1 ? 'like' : 'unlike'; ?></td>
                            <td>
                                <a href="edit.php?numArt=<?= $like['numArt']; ?>&numMemb=<?= $like['numMemb']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?= $like['numArt']; ?>&numMemb=<?= $like['numMemb']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>
