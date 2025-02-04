<?php 
require_once 'header.php';
sql_connect();
session_start(); // Démarre la session pour récupérer les informations utilisateur
?>

<!-- Afficher le message de bienvenue après une connexion réussie -->
<?php
if (isset($_GET['message']) && $_GET['message'] == 'connexion_reussie') {
    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['pseudoMemb'])) {
        echo "<p style='color: green;'>Connexion réussie ! Bienvenue, " . $_SESSION['pseudoMemb'] . ".</p>";
    }
}
?>

<!-- Le contenu principal de la page -->
<div class="container">
    <h1>Bienvenue sur le BlogArt25</h1>
    <!-- Vous pouvez ajouter ici plus de contenu, des articles, etc. -->
    <p>Nous espérons que vous apprécierez votre visite sur notre blog !</p>
</div>

<?php require_once 'footer.php'; ?>
