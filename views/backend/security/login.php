<?php
include '../../../header.php';

global $DB;

$se_souvenir = isset($_POST["se_souvenir"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["pseudonyme"]) && !empty($_POST["mot_de_passe"])) {
        $pseudo = $_POST["pseudonyme"];
        $password = sha1($_POST["mot_de_passe"]);

        $sql = "SELECT * FROM inscription WHERE password = :mot_de_passe AND pseudo = :pseudo";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['pseudo' => $pseudo, 'mot_de_passe' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            if ($user["code_email"] != null) {
                echo "L'utilisateur n'a pas activé son compte par email";
            } else {
                $_SESSION["pseudonyme"] = $pseudo;

                $code_cookie = password_hash(uniqid(), PASSWORD_DEFAULT);
                var_dump($code_cookie);
                if ($se_souvenir) {
                    setcookie("code_cookie", $code_cookie, time() + (30 * 24 * 3600));
                }

                $sql = "UPDATE inscription SET code_cookie = :code_cookie WHERE pseudo = :pseudo";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(['pseudo' => $pseudo, 'code_cookie' => $code_cookie]);

                if ($se_souvenir) {
                    echo "Cookie défini !";
                } else {
                    echo "Cookie non défini !";
                }

                header("Location: ../../../header.php");
                exit();
            }
        } else {
            echo "Pseudonyme ou mot de passe incorrect.";
        }
    } else {
        echo "Veuillez entrer un pseudonyme et un mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html style=text-align:center>

<head>
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>
    <form action="login.php" method="post">
        <input type="text" name="pseudonyme" placeholder="Pseudonyme"><br>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe"><br>
        <input type="checkbox" name="se_souvenir" value="1"> Se souvenir de moi<br>
        <div class="form-group mt-2">
            
                    <button type="submit" class="btn btn-success"> Envoyer</button>
    </form>
</body>

</html>