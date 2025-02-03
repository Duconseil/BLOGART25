<?php
include '../../../header.php'; // contains the header and call to config.php

// Load all articles with the related thematique
$articles = sql_select('ARTICLE INNER JOIN THEMATIQUE ON article.numThem = thematique.numThem', '*');

?>
<!-- Bootstrap default layout to display all articles in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Chapeau</th>
                        <th>Accroche</th>
                        <th>Mot Cle</th> 
                        <th>Thématique</th> 
                        <th>Photo</th>  <!-- New column for photo -->
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($articles as $article){ 
                        $numArt = $article['numArt']; // Get the article number
                        $listMot = sql_select('ARTICLE
                        INNER JOIN MOTCLEARTICLE ON article.numArt = motclearticle.numArt
                        INNER JOIN motcle ON motclearticle.numMotCle = motcle.numMotCle', 'article.numArt, libMotCle', "article.numArt = '$numArt'");
                    ?> 
                        <tr>
                            <td><?php echo($article['numArt']); ?></td>
                            <td><?php echo($article['dtCreaArt']); ?></td>
                            <td><?php echo($article['libTitrArt']); ?></td>
                            <td><?php echo($article['libChapoArt']); ?></td>
                            <td><?php echo($article['libAccrochArt']); ?></td>
                            <td><?php 
                                foreach ($listMot as $mot){
                                    echo($mot['libMotCle'] . ', ');
                                }
                            ?></td> 
                            <td><?php echo($article['libThem']); ?></td>
                            <td>
                                <!-- Display image for the article -->
                                <img src="<?php echo ROOT_URL . '/src/uploads/' . str_replace('.jpg', '.png', $article['urlPhotArt']); ?>" alt="Article Image" style="max-width: 200px; height: auto;">
                            </td>
                            <td>
                                <a href="edit.php?numArt=<?php echo($article['numArt']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?php echo($article['numArt']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>

<?php
include '../../../footer.php'; // contains the footer
?>
