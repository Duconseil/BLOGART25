<?php  
require_once '../../header.php';
sql_connect();

if(isset($_GET)) {
    $numArt = $_GET['numArt'];
}

$numArt = (int)$_GET['numArt'];
$articleData = sql_select("ARTICLE", "*", "numArt = $numArt");

if (empty($articleData)) {
    die("Article non trouvé.");
}
$article = $articleData[0];
$thematiques = sql_select("THEMATIQUE", "*");
$keywords = sql_select("MOTCLE", "*");
$selectedKeywords = sql_select("MOTCLEARTICLE", "*", "numArt = $numArt");

$listMot = sql_select(
    'ARTICLE
    INNER JOIN MOTCLEARTICLE ON ARTICLE.numArt = MOTCLEARTICLE.numArt
    INNER JOIN MOTCLE ON MOTCLEARTICLE.numMotCle = MOTCLE.numMotCle',
    'ARTICLE.numArt, libMotCle',
    "ARTICLE.numArt = '$numArt'"
);

$article = $articleData[0];

//var_dump($numArt);

$userVote = null;
$libCom = isset($_POST['libCom']) ? ($_POST['libCom']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Vous devez être connecté pour ajouter un commentaire ou un like.";
        header(header: "Location: " . ROOT_URL . "/views/backend/security/login.php");
        exit();
    }

    if (isset($_POST['libCom'])) {
        $numMemb = $_SESSION['user_id'];
        $libCom = ($_POST['libCom']);
        $numArt = (int)$_POST['numArt'];
        if (!empty($libCom) && !empty($numArt) && !empty($numMemb)) {
            sql_insert('comment', 'libCom, numArt, numMemb', "'$libCom', '$numArt', '$numMemb'");
            echo "<p style='color: green;'>Commentaire ajouté avec succès !</p>";
        } else {
            echo "<p style='color: red;'>Erreur : tous les champs doivent être remplis correctement.</p>";
        }
    } else {

    
        $numMemb = $_SESSION['user_id'];
        $likeA = (int)$_POST['likeA'];

        $existingVote = sql_select("LIKEART", "*", "numArt = $numArt AND numMemb = $numMemb");

        if (!empty($existingVote)) {
            sql_update("LIKEART", "likeA = $likeA", "numArt = $numArt AND numMemb = $numMemb");
        } else {
            sql_insert("LIKEART", "numArt, numMemb, likeA", "'$numArt', '$numMemb', '$likeA'");
        }

        header("Location: article.php?numArt=$numArt");
        exit();
    }
}



$numArt = $_GET['numArt']; 
$comments = sql_select("comment c 
                        INNER JOIN membre m ON c.numMemb = m.numMemb 
                        WHERE c.numArt = $numArt 
                        AND c.delLogiq = 0", 
                        "c.libCom, c.dtCreaCom, m.pseudoMemb");
$comments = sql_select("comment c 
                        INNER JOIN membre m ON c.numMemb = m.numMemb 
                        WHERE c.numArt = $numArt 
                        AND c.delLogiq = 0
                        AND c.attModOK = 1", 
                        "c.libCom, c.dtCreaCom, m.pseudoMemb");
$article = sql_select("article", "*", "numArt = $numArt")[0];




$articlecible = sql_select('ARTICLE', '*', "numArt = $numArt")[0];
//var_dump($articlecible);    

$likeCount = sql_select("LIKEART", "COUNT(*) as count", "numArt = $numArt AND likeA = 1")[0]['count'] ?? 0;
$dislikeCount = sql_select("LIKEART", "COUNT(*) as count", "numArt = $numArt AND likeA = 0")[0]['count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Article sur Michel Corajoud">
    <title>Michel Corajoud - Rétroscope</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="/blogart25/styles.css" rel="stylesheet">

</head>

<body>

    <header class="masthead">
        <div class="container">
            <div class="article-header">
                <h1><?php echo $articlecible['libTitrArt']?></h1>
                <div class="article-chapo">
                    <h2>
                    <?php echo $articlecible['libChapoArt']?>
                    </h2>
                    <h3>
                    <?php echo $articlecible['libAccrochArt']?>
                    </h3>
                </div>
                <span class="meta">
                    Posté par <a href="#!">Rétroscope</a>, le  <?php echo $articlecible['dtCreaArt']?>

                </span>
            </div>
        </div>
    </header>

    <article class="container">

    <div class="image-wrapper">
        <img src="\src\uploads\<?php echo $articlecible['urlPhotArt'];?>" alt="Image principale de l'article" class="article-image">
    </div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 article-content">
                <p>
                <?php echo $articlecible['parag1Art']?>
                </p>
                <h2>
                <?php echo $articlecible['libSsTitr1Art']?>
                </h2>
                <p>
                <?php echo $articlecible['parag2Art']?>
                </p>
                <h2>
                <?php echo $articlecible['libSsTitr2Art']?>
                </h2>
                <p>
                <?php echo $articlecible['parag3Art']?>
                </p>
                <blockquote class="blockquote">
                <?php echo $articlecible['libConclArt']?>
                </blockquote>
            </div>
                <div class="container likes-section">
                    <h2>Évaluer cet article</h2>
                    <div class="vote-buttons">
                    <div style="display: flex; align-items: center;">
    <form action="/frontend/evenement.php?numArt=<?php echo $numArt; ?>" method="post">
        <input type="hidden" name="numArt" value="<?php echo $numArt; ?>">
        <input type="hidden" name="likeA" value="1">
        <button type="submit" class="btn-vote <?php echo $userVote === 1 ? 'active-like' : ''; ?>">
            <img src="<?php echo ROOT_URL; ?>/src/images/like.png" width="40px" alt="Like">
            <h3><?php echo $likeCount; ?></h3>
        </button>
    </form>

    <form action="/views/frontend/evenement.php?numArt=<?php echo $numArt; ?>" method="post">
        <input type="hidden" name="numArt" value="<?php echo $numArt; ?>">
        <input type="hidden" name="likeA" value="0">
        <button type="submit" class="btn-vote <?php echo $userVote === 0 ? 'active-dislike' : ''; ?>">
            <img src="<?php echo ROOT_URL; ?>/src/images/dislike.png" width="40px" alt="Dislike">
            <h3><?php echo $dislikeCount; ?></h3>
        </button>
    </form>
</div>

                    </div>
                </div>
            </div>
            <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Ajouter un commentaire</h2>
                        </div>
                        <div class="col-md-12">
                        <form action="/views/frontend/evenement.php?numArt=<?php echo $numArt; ?>" method="post">
                            <div class="champ">
                        <textarea id="libCom" name="libCom" class="form-control" type="text" required></textarea>
                        </div>
                        <input type="hidden" name="numArt" value="<?php echo $numArt; ?>" />
                    <br />
                    <div class="btn-se-connecter">
                    <button type="submit" class="btn btn-success">Envoyer</button>
                    <br>
                    </div>  
                </form>
            </div>

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Commentaires</h2>
                            <?php if (!empty($comments)): ?>
                                <ul >
                                    <?php foreach ($comments as $comment): ?>
                                        <div>
                                            <li class="list-group-item">
                                            <span class="pseudo"><?php echo ($comment['pseudoMemb']); ?></span> 
                                            a écrit le 
                                            <span class="date"><?php echo ($comment['dtCreaCom']); ?> :</span>
                                            <p class="commentaire"><?php echo nl2br(($comment['libCom'])); ?></p>
                                            </li>
                                        </div>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>Il n'y a pas encore de commentaires pour cet article.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

        </div>
    </article>

    <footer class="border-top">
        <div class="container text-center">
            <p class="small text-muted">Copyright &copy; Rétroscope. 2025</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

<style>

.article-header {
    margin-top: 20px;
    text-align: center;
    margin-bottom: 40px;
}

.article-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    margin-bottom: 20px;
    border-radius: 5px;
}

.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.article-content h2 {
    margin-top: 40px;
    margin-bottom: 15px;
    font-weight: bold;
    text-transform: uppercase;
    border-left: 6px solid #444;
    padding-left: 10px;
}

.blockquote {
    font-style: italic;
    border-left: 4px solid #888;
    padding-left: 15px;
    margin: 30px 0;
    color: #555;
}

.article-chapo {
    font-family: 'Open Sans', serif;
    font-size: 1.2rem;
    font-weight: 400;
    line-height: 1.6;
    max-width: 800px;
    margin: 10px auto;
    text-align: justify;
}

.article-chapo h2 {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.article-chapo h3 {
    font-size: 1.2rem;
    font-weight: normal;
    font-style: italic;
    color: #555;
}

.article-header h1 {
    font-family: 'Open Sans', serif;
    font-size: 2.2rem;
    font-weight: bold;
    margin-top: 50px;
    margin-bottom: 20px;
}

.article-chapo {
    font-family: 'Open Sans', sans-serif; 
    font-size: 1.2rem;
    font-weight: 400;
    line-height: 1.6;
    max-width: 800px;
    margin: 20px auto 30px auto;
    text-align: justify;
}

.article-chapo h2 {
    font-family: 'Open Sans', sans-serif; 
    font-size: 1.4rem;
    font-weight: 600; 
    letter-spacing: 0.5px;
    margin-bottom: 15px;
}

.article-chapo h3 {
    font-family: 'Open Sans', sans-serif;
    font-size: 1.2rem;
    font-weight: 400;
    font-style: italic;
    color: #555;
    margin-bottom: 30px;
}

.meta {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.9rem;
    color: #777;
    display: block;
    margin-top: 20px;
}

.image-wrapper {
    position: relative;
    display: flex;
    justify-content: center; 
    align-items: center;
    width: 100%;
}

.article-image {
    width: 100%;
    max-width: 800px; 
    height: auto;
    display: block;
    border-radius: 5px;
}

.logo-overlay {
    position: absolute;
    top: 15px;
    right: 170px;
    width: 70px; 
    height: auto;
    opacity: 0.9; 
}

</style>
