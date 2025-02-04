<?php
// Inclure le fichier de connexion ou initialisation de la base de données
include '../../../header.php';

global $DB; // Assurez-vous que cette variable contient la connexion PDO

// Vérifiez si la connexion à la base de données est déjà initialisée
if ($DB === null) {
    try {
        // Connexion à la base de données
        $DB = new PDO('mysql:host=localhost;dbname=BLOGART25', 'root', 'root');
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Si la connexion échoue, affichez le message d'erreur
        die("Impossible de se connecter à la base de données: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si les champs nécessaires sont renseignés
    if (!empty($_POST["pseudoMemb"]) && !empty($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe_confirm"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["eMailMemb"]) && isset($_POST["statut"])) {
        $pseudoMemb = trim($_POST["pseudoMemb"]);
        $passMemb = trim($_POST["mot_de_passe"]);
        $passMembConfirm = trim($_POST["mot_de_passe_confirm"]);
        $prenomMemb = trim($_POST["prenom"]);
        $nomMemb = trim($_POST["nom"]);
        $eMailMemb = trim($_POST["eMailMemb"]);
        $statut = (int)$_POST["statut"]; // Assurez-vous que le statut est un entier valide

        // Vérifier que les mots de passe sont identiques
        if ($passMemb !== $passMembConfirm) {
            echo "<p style='color:red;'>Les mots de passe ne correspondent pas.</p>";
        } else {
            // Hacher le mot de passe pour le stockage sécurisé
            $passMembHashed = sha1($passMemb);

            try {
                // Vérifier si le pseudo est déjà pris
                $sql = "SELECT * FROM membre WHERE pseudoMemb = :pseudoMemb";
                $stmt = $DB->prepare($sql);
                $stmt->execute(['pseudoMemb' => $pseudoMemb]);
                $existingUser = $stmt->fetch();

                if ($existingUser) {
                    echo "<p style='color:red;'>Ce pseudonyme est déjà pris. Veuillez en choisir un autre.</p>";
                } else {
                    // Insérer un nouvel utilisateur dans la base de données
                    $sql = "INSERT INTO membre (pseudoMemb, passMemb, prenomMemb, nomMemb, eMailMemb, numStat) VALUES (:pseudoMemb, :passMemb, :prenomMemb, :nomMemb, :eMailMemb, :numStat)";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute([
                        'pseudoMemb' => $pseudoMemb,
                        'passMemb' => $passMembHashed,
                        'prenomMemb' => $prenomMemb,
                        'nomMemb' => $nomMemb,
                        'eMailMemb' => $eMailMemb,
                        'numStat' => $statut // Valeur dynamique en fonction du statut sélectionné
                    ]);

                    echo "<p style='color:green;'>Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</p>";
                }
            } catch (PDOException $e) {
                echo "<p style='color:red;'>Erreur de requête : " . $e->getMessage() . "</p>";
            }
        }
    } else {
        // Si l'un des champs est vide ou si le statut n'est pas sélectionné
        echo "<p style='color:red;'>Veuillez remplir tous les champs et choisir un statut.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function togglePassword(id) {
            var passMemb = document.getElementById(id);
            if (passMemb.type === "password") {
                passMemb.type = "text";
            } else {
                passMemb.type = "password";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="signup.php" method="post" class="form-container">
            <div class="form-group">
                <label for="pseudoMemb">Pseudo</label>
                <input type="text" name="pseudoMemb" placeholder="Pseudonyme" minlength="6" required>
                <p>(au moins 6 caractères)</p>
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
                <p>(au moins 6 caractères)</p>
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
                <input type="checkbox" onclick="togglePassword('mot_de_passe_confirm')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <select class="form-control" name="statut" id="statut" required>
                    <option value="1">Utilisateur</option>
                    <option value="2">Administrateur</option>
                    <option value="3">Modérateur</option>
                </select>
            </div>

            <div class="form-group">
                <label>J'accepte que mes données soient conservées</label>
                <input type="radio" name="accepte_donnees" value="oui" required> Oui
                <input type="radio" name="accepte_donnees" value="non" required> Non
            </div>

            <div class="form-group">
                <button type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
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
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        font-size: 0.9em;
        color: #666;
    }

    .form-group button {
        background-color: #28a745;
        color: white;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #218838;
    }
</style>
