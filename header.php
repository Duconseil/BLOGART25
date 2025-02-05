<?php
require_once 'config.php'; // Charger la configuration

// Vérifier si la session n'est pas déjà active avant de la démarrer
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et si la session contient les informations nécessaires
$pseudo = $_SESSION['pseudoMemb'] ?? null;
$numStat = $_SESSION['numStat'] ?? null;  // Récupérer numStat ou null si non défini

// Déboguer les valeurs de session (enlève ce bloc après test)
// var_dump($pseudo, $numStat); // Vérifier que ces valeurs sont bien définies et correctes
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog'Art</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="src/css/style.css" />
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/x-icon" href="src/images/article.png" />
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/src/images/Retroscope.png" alt="Blog'Art 25" style="height: 40px; width: auto;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/views/frontend/actors.php">Acteurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/views/frontend/events.php">Événements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/views/frontend/original.php">Insolite</a>
        </li>
      </ul>
    </div>

    <!-- Zone de droite -->
    <div class="d-flex align-items-center">
      <form class="d-flex me-2" role="search">
          <input class="form-control me-2" type="search" placeholder="Rechercher sur le site…" aria-label="Search">
      </form>

      <!-- Si l'utilisateur est connecté -->
      <?php if ($pseudo): ?>
        <div class="d-flex align-items-center me-3">
          <span class="ms-2 fw-bold"><?php echo htmlspecialchars($pseudo); ?></span>
        </div>
        <a class="btn btn-danger m-1" href="/api/security/disconnect.php" role="button">Déconnexion</a>

        <!-- Afficher le bouton Admin seulement si l'utilisateur n'est pas un membre (numStat != 3) -->
        <?php if ($numStat !== 3): ?>
          <a class="btn btn-primary" href="http://localhost:8888/views/backend/dashboard.php" role="button">Admin</a>
        <?php endif; ?>

      <?php else: ?>
        <a class="btn btn-primary m-1" href="/views/backend/security/login.php" role="button">Login</a>
        <a class="btn btn-dark m-1" href="/views/backend/security/signup.php" role="button">Sign up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Kw1Wrh/tb6SVkzF6FA5Hq5j5jzgFgnxP/1R" crossorigin="anonymous"></script>

</body>
</html>
