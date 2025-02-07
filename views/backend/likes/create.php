<?php
include '../../../header.php';

$members = [];
$allArticles = [];

$members = sql_select("MEMBRE", "numMemb, pseudoMemb", "1");

$allArticles = sql_select("ARTICLE", "numArt, libTitrArt", "1");

if (isset($_POST['numMemb']) && !empty($_POST['numMemb'])) {
    $numMemb = $_POST['numMemb'];

    $likedArticles = sql_select("likeart", "numArt", "numMemb = $numMemb");

    $likedArticleIds = array_map(function($article) {
        return $article['numArt'];
    }, $likedArticles);

    if (!empty($likedArticleIds)) {
        $allArticles = sql_select("ARTICLE", "numArt, libTitrArt", 
            "numArt NOT IN (" . implode(",", $likedArticleIds) . ")");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numMemb']) && isset($_POST['numArt'])) {
    $numMemb = $_POST['numMemb'];
    $numArt = $_POST['numArt'];

    $insertResult = sql_insert("likeart", [
        'numMemb' => $numMemb,
        'numArt' => $numArt
    ]);

    if ($insertResult) {
        header("Location: list.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout du like.</div>";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un nouveau like</h1>
        </div>
        <div class="col-md-12">
            <form action="create.php" method="post">
                <div class="form-group">
                    <label for="numMemb">Membre</label>
                    <select id="numMemb" name="numMemb" class="form-control" required>
                        <option value="">- - - Choisissez un membre - - -</option>
                        <?php foreach ($members as $member): ?>
                            <option value="<?php echo $member['numMemb']; ?>"><?php echo $member['pseudoMemb']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="numArt">Article à liker</label>
                    <select id="numArt" name="numArt" class="form-control" required>
                        <option value="">- - - Choisissez un article - - -</option>
                        <?php foreach ($allArticles as $article): ?>
                            <option value="<?php echo $article['numArt']; ?>"><?php echo $article['libTitrArt']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste des Likes</a>
                    <button type="submit" class="btn btn-success">Confirmer la création</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>
