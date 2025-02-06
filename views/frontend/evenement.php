<?php  
require_once '../../header.php';
sql_connect();

if(isset($_GET)) {
    $numArt = $_GET['numArt'];
}

//var_dump($numArt);

$articlecible = sql_select('ARTICLE', '*', "numArt = $numArt")[0];
//var_dump($articlecible);    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Article sur Michel Corajoud">
    <title>Michel Corajoud - Rétroscope</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- Font Awesome & Google Fonts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Bootstrap & Styles -->
    <link href="/blogart25/styles.css" rel="stylesheet">

</head>

<body>

    <!-- En-tête de l'article avec image -->
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

    <!-- Contenu de l'article -->
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
        </div>
    </article>

    <!-- Pied de page -->
    <footer class="border-top">
        <div class="container text-center">
            <p class="small text-muted">Copyright &copy; Rétroscope. 2025</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

<style>

/* Espacement et mise en page améliorés */
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

        /* Titre principal - Élégant et impactant */
.article-header h1 {
    font-family: 'Open Sans', serif;
    font-size: 2.2rem;
    font-weight: bold;
    margin-top: 50px;
    margin-bottom: 20px;
}

/* Harmonisation du Chapô */
.article-chapo {
    font-family: 'Open Sans', sans-serif; /* Uniformisation avec le contenu */
    font-size: 1.2rem;
    font-weight: 400;
    line-height: 1.6;
    max-width: 800px;
    margin: 20px auto 30px auto;
    text-align: justify;
}

/* Sous-titre du Chapô - Plus moderne */
.article-chapo h2 {
    font-family: 'Open Sans', sans-serif; /* Cohérent avec l'article */
    font-size: 1.4rem;
    font-weight: 600; /* Semi-gras pour une meilleure visibilité */
    letter-spacing: 0.5px;
    margin-bottom: 15px;
}

/* Petit sous-titre du Chapô - Italique et adouci */
.article-chapo h3 {
    font-family: 'Open Sans', sans-serif;
    font-size: 1.2rem;
    font-weight: 400;
    font-style: italic;
    color: #555;
    margin-bottom: 30px;
}

/* Métadonnées - Cohérence visuelle */
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
    justify-content: center; /* Centre l'image horizontalement */
    align-items: center;
    width: 100%;
}

.article-image {
    width: 100%;
    max-width: 800px; /* Garde une taille raisonnable */
    height: auto;
    display: block;
    border-radius: 5px;
}

.logo-overlay {
    position: absolute;
    top: 15px;
    right: 170px;
    width: 70px; /* Taille ajustable */
    height: auto;
    opacity: 0.9; /* Légère transparence */
}

</style>