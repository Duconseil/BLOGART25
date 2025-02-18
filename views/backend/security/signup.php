<?php
include '../../../header.php';

$recaptchaSecret = '6Lej580qAAAAAJJoCPyuzSi5-Hs-lFr9ylkq_oMD'; 

include '../../../config/defines.php';

try {
    $dsn = "mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB . ";port=" . (SQL_PORT ?? 3306);  
    
    $DB = new PDO($dsn, SQL_USER, SQL_PWD);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données: " . $e->getMessage);

};

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'content' => http_build_query($data),
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captchaSuccess = json_decode($verify)->success;

        if (!$captchaSuccess) {
            echo "<p style='color:red;'>La vérification reCAPTCHA a échoué. Veuillez réessayer.</p>";
        } else {*/
            if (!empty($_POST["pseudoMemb"]) && !empty($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe_confirm"]) &&
                !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["eMailMemb"]) && !empty($_POST["eMailMemb_confirm"])) {

                $pseudoMemb = trim($_POST["pseudoMemb"]);
                $passMemb = trim($_POST["mot_de_passe"]);
                $passMembConfirm = trim($_POST["mot_de_passe_confirm"]);
                $prenomMemb = trim($_POST["prenom"]);
                $nomMemb = trim($_POST["nom"]);
                $eMailMemb = trim($_POST["eMailMemb"]);
                $eMailMembConfirm = trim($_POST["eMailMemb_confirm"]);
                $numStat = 3;
                $optin = $_POST['acceptedonnees'];

                if ($passMemb !== $passMembConfirm) {
                    echo "<p style='color:red;'>Les mots de passe ne correspondent pas.</p>";
                } elseif ($eMailMemb !== $eMailMembConfirm) {
                    echo "<p style='color:red;'>Les emails ne correspondent pas.</p>";
                } else {
                    $passMembHashed = password_hash($passMemb, PASSWORD_BCRYPT);
                    try {
                        $sql = "SELECT * FROM MEMBRE WHERE pseudoMemb = :pseudoMemb";
                        $stmt = $DB->prepare($sql);
                        $stmt->execute(['pseudoMemb' => $pseudoMemb]);
                        
                        if ($stmt->fetch()) {
                            echo "<p style='color:red;'>Ce pseudonyme est déjà pris. Veuillez en choisir un autre.</p>";
                        } else {
                                $inscription = sql_insert('MEMBRE', 'pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, numStat, accordMemb', "'$pseudoMemb', '$prenomMemb', '$nomMemb', '$passMembHashed', '$eMailMemb', '$numStat', '$optin'");

                            echo "<p style='color:green;'>Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p style='color:red;'>Erreur de requête : " . $e->getMessage() . "</p>";
                    }
                }
            } else {
                echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
            }
        /*} else {
            echo "<p style='color:red;'>Veuillez compléter la vérification reCAPTCHA.</p>";
        }*/
}
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
                <p>(8-15 caractères, une majuscule, une minuscule, un chiffre, un caractère spécial)</p>
                <input type="checkbox" onclick="togglePassword('mot_de_passe')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label for="mot_de_passe_confirm">Confirmez Mot de passe</label>
                <input type="password" id="mot_de_passe_confirm" name="mot_de_passe_confirm" placeholder="Confirmez Mot de passe" minlength="8" maxlength="15" required>
                <p>(8-15 caractères, une majuscule, une minuscule, un chiffre, un caractère spécial)</p>
                <input type="checkbox" onclick="togglePassword('mot_de_passe_confirm')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label>J'accepte que mes données soient conservées</label>
                        <input type="radio" id="validoui"checked name="acceptedonnees" value="1" />
                        <label for="validoui">J'accepte</label> <br>
                        <input type="radio" id="validnon" name="acceptedonnees" value="0" />
                        <label for="validnon">Je refuse</label><br> <br>
            </div>
            

            <!-- reCAPTCHA -->
            <!--
            <div class="form-group recaptcha-container">
                <div class="g-recaptcha" 
                        data-sitekey="6Lej580qAAAAAA0kk8ZyqeYBfdvf672_e7j_gamY" 
                        data-callback="onSubmit" 
                        data-action="submit">
                </div>
            </div>
            -->

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
