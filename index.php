<?php 
require_once 'header.php';
sql_connect();

$allarticles = sql_select('ARTICLE', '*', "numArt >= 1 AND numArt <= 4");
//$allarticles = sql_select('ARTICLE', '*', where: "WHERE numArt BETWEEN 1 AND 4")

//var_dump($allarticle);


?>

<?php
if (isset($_GET['message']) && $_GET['message'] == 'connexion_reussie') {
    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['pseudoMemb'])) {
        echo "<p style='color: green;'>Connexion réussie ! Bienvenue, " . $_SESSION['pseudoMemb'] . ".</p>";
    }
}
?>

<?php 
require_once 'header.php';
sql_connect();
?>

<html lang="fr">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog d'articles - Rétroscope</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <link href="/blogart25/styles.css" rel="stylesheet" />

    <style>
        .masthead {
            position: relative;
            background-image: url('src/images/fondbordeaux.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .masthead::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); 
        }

        .site-heading {
            position: relative;
            z-index: 1; 
            text-align: center;
        }

        .site-heading h1 {
            font-size: 3.5rem;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6); 
        }

        .site-heading .subheading {
            color: #ddd;
            font-size: 1.2rem;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .post-preview {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .post-preview:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .post-preview img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .post-preview:hover img {
            transform: scale(1.05);
        }

        .post-title {
            font-size: 1.75rem;
            color: #333;
            margin: 20px;
        }

        .post-subtitle {
            font-size: 1rem;
            color: #666;
            margin: 0 20px 20px;
        }

        .post-meta {
            color: #999;
            font-size: 0.9rem;
            margin-left: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-transform: uppercase;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .container {
            margin-top: 50px;
        }


        .insolite-articles {
            flex: 2; 
        }


        .post-preview {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .post-preview:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .post-preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .post-preview:hover img {
            transform: scale(1.05);
        }

        .section-insolite {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 50px;
            margin-bottom: 50px;
        }

    </style>

</head>

<body>
    <header class="masthead">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading text-center">
                        <h1>Rétroscope.</h1>
                        <span class="subheading">Atelier Blog'Art - 2025</span>
                    </div>
                    <hr class="my-4" />
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <?php foreach ($allarticles as $allarticle) : ?>
                <div class="post-preview">
                    <a href="/views/frontend/evenement.php?numArt=<?php echo $allarticle['numArt']; ?>">
                        <img src="src/uploads/<?php echo $allarticle['urlPhotArt'];?>" alt="Article Image">
                        <h2 class="post-title"><?php echo $allarticle['libTitrArt'];?></h2>
                    </a>
                    <h3 class="post-subtitle"><?php echo $allarticle['libChapoArt'];?></h3>
                    <p class="post-meta">Posté le <a href="#!"><?php echo $allarticle['dtCreaArt'];?></a></p>
                </div>
                <?php endforeach;?>
                </div>
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="#!">Anciens posts →</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php require_once 'footer.php'; ?>
