<?php
session_start();
include '../../../header.php';

// Récupération des données de session
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
$old = $_SESSION['old'] ?? [];

// Nettoyage des données de session après récupération
unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['old']);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function togglePassword(id) {
            var passMemb = document.getElementById(id);
            passMemb.type = passMemb.type === "password" ? "text" : "password";
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form id="form-recaptcha" action="signup.php" method="post" class="form-container">
            <div class="form-group">
                <label for="pseudoMemb">Pseudo</label>
                <input type="text" name="pseudoMemb" placeholder="Pseudonyme" minlength="6" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" placeholder="Nom" required>
            </div>

            <div class="form-group">
                <label for="eMailMemb">Email</label>
                <input type="email" name="eMailMemb" placeholder="Email" minlength="6" required>
            </div>

            <div class="form-group">
                <label for="eMailMemb_confirm">Confirmez Email</label>
                <input type="email" name="eMailMemb_confirm" placeholder="Confirmez Email" minlength="6" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" minlength="8" maxlength="15" required>
                <input type="checkbox" onclick="togglePassword('mot_de_passe')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label for="mot_de_passe_confirm">Confirmez Mot de passe</label>
                <input type="password" id="mot_de_passe_confirm" name="mot_de_passe_confirm" placeholder="Confirmez Mot de passe" minlength="8" maxlength="15" required>
                <input type="checkbox" onclick="togglePassword('mot_de_passe_confirm')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label>J'accepte que mes données soient conservées</label>
                        <input type="radio" id="validoui"checked name="acceptedonnees" value="1" />
                        <label for="validoui">J'accepte</label> <br>
                        <input type="radio" id="validnon" name="acceptedonnees" value="0" />
                        <label for="validnon">Je refuse</label><br> <br>
            </div>


            <div class="form-group">
                <button type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
    <script>
        function onSubmit(token) {
            document.getElementById("form-recaptcha").submit();
        }
    </script>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 20px;
        background-color: #f4f4f4;
    }

    h1 {
        color: #333;
    }

    .form-container {
        width: 50%;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group input, .form-group button {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-group p {
        font-size: 12px;
        color: #777;
    }

    .form-group button {
        background-color: #5cb85c;
        color: white;
        border: none;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #4cae4c;
    }

    /* CSS pour centrer le reCAPTCHA */
    .recaptcha-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .g-recaptcha {
        display: inline-block;
        margin: 0 auto;
    }
</style>
