<?php
require_once 'config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$pseudo =  $_SESSION['pseudo'] ?? null;
$numStat = $_SESSION['statut'] ?? null;  
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog'Art</title>

    <link rel="stylesheet" href="/src/css/style.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
            crossorigin="anonymous" />

    <link rel="shortcut icon" type="image/x-icon" href="src/images/article.png" />
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        
        <a class="navbar-brand" href="#">
            <img src="/src/images/Retroscope.png" alt="Blog'Art 25" style="height: 60px; width: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/views/frontend/evenement.php?numArt=1">Acteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/views/frontend/evenement.php?numArt=2">Acteurs</a>
                </li>
                <li class="nav-item">
                    <a id="open-menu" class="nav-link" href="#">Insolite</a>
                </li>
            </ul>
            
            <ul class="navbar-nav menu-open">
                <li class="nav-item">
                    <a class="nav-link" href="/views/frontend/evenement.php?numArt=3">Insolite n°1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/views/frontend/evenement.php?numArt=4">Insolite n°2</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            
            <form class="d-flex me-2" role="search">
                <input class="form-control me-2" type="search" placeholder="Rechercher sur le site…" aria-label="Search">
            </form>

            <?php if ($pseudo): ?>
                <div class="d-flex align-items-center me-3">
                    <span class="ms-2 fw-bold"><?php echo htmlspecialchars($pseudo); ?></span>
                </div>
                <a class="btn btn-danger m-1" href="/api/security/disconnect.php" role="button">Déconnexion</a>

                <?php if ($numStat !== 3): ?>
                    <a class="btn btn-primary" href="http://localhost:8888/views/backend/dashboard.php" role="button">Admin</a>
                <?php endif; ?>

            <?php else: ?>
                <a class="btn btn-primary m-1" href="/views/backend/security/login.php" role="button">Se connecter</a>
                <a class="btn btn-dark m-1" href="/views/backend/security/signup.php" role="button">S'inscrire</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ho+j7jyWK8fNQe+A12Kw1Wrh/tb6SVkzF6FA5Hq5j5jzgFgnxP/1R" 
        crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const openMenu = document.getElementById('open-menu');
        const menu = document.querySelector('.menu-open');

        menu.style.display = "none";

        openMenu.addEventListener('click', (event) => {
            event.preventDefault(); 
            if (menu.style.display === "none") {
                menu.style.display = "flex";
            } else {
                menu.style.display = "none";
            }
        });
    });
</script>

</body>
</html>

<style>
    .navbar {
        padding: 15px 30px;
    }

    .navbar-nav .nav-item {
        margin-right: 15px;
    }

    .navbar-brand img {
        margin-right: 15px;
    }

    .d-flex.align-items-center {
        gap: 15px;
    }

    form.d-flex {
        margin-right: 15px;
    }

    .navbar .btn {
        padding: 8px 15px;
    }

    .navbar-toggler {
        margin-left: 10px;
    }

    /* Caché par défaut */
    .menu-open {
        display: none;
        flex-direction: row; 
        gap: 15px; 
        align-items: center; 
        margin-left: 15px;
    }

    .menu-open .nav-item {
        padding-left: 15px;
    }
</style>
