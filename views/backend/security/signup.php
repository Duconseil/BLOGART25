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

<main>

    <h1>Créer mon compte</h1>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <div class="container mb-4">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-2">
                    <?php foreach ($errors as $error): ?>
                        <?= htmlspecialchars($error) ?><br>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <form action="<?php echo ROOT_URL . '/api/security/signup.php' ?>" method="post">
        <!-- Prénom -->
        <div class="rowlog">
            <div class="collumnslog" >
                <div class="champ">
                    <label for="prenomMemb">Prénom :</label>
                    <input type="text" name="prenomMemb" value="<?= htmlspecialchars($old['prenomMemb'] ?? '') ?>" required>
                </div>

                <!-- Nom -->
                <div class="champ">
                    <label for="nomMemb">Nom :</label>
                    <input type="text" name="nomMemb" value="<?= htmlspecialchars($old['nomMemb'] ?? '') ?>" required>
                </div>
                    <!-- Pseudo -->
                <div class="champ">
                    <label for="pseudo" placeholder="6 à 70 caractères">Pseudo</label>
                    <input type="text" 
                            name="pseudoMemb" 
                            value="<?= htmlspecialchars($old['pseudoMemb'] ?? '') ?>"
                            required>
                    <small class="form-text text-muted">6 à 70 caractères</small>
                </div>
            </div>
            <div class="collumnslog">
                <!-- Email -->
                <div class="champ">
                    <label for="email">Email :</label>
                    <input type="email" name="eMailMemb" value="<?= htmlspecialchars($old['eMailMemb'] ?? '') ?>" required>
                </div>

                <!-- Confirmation Email -->
                <div class="champ">
                    <label for="email">Confirmer l'email :</label>
                    <input type="email" name="eMailMemb2" value="<?= htmlspecialchars($old['eMailMemb2'] ?? '') ?>" required>
                </div>

                <!-- Mot de passe -->
                <div class="champ">
                    <label for="passMemb">Mot de passe :</label>
                    <input type="password" id="passMemb" name="passMemb" required>
                    <div class="afficher-mdp">
                        <input type="checkbox" onclick="togglePassword('passMemb')"> Afficher mot de passe
                    </div>
                </div>
                
                <!-- Confirmation mot de passe -->
                <div class="champ">
                    <label for="passMemb2">Confirmation du mot de passe :</label>
                    <input type="password" id="passMemb2" name="passMemb2" required>
                    <div class="afficher-mdp">
                        <input type="checkbox" onclick="togglePassword('passMemb2')"> Afficher mot de passe
                    </div>
                </div>
            </div>
        </div>
        <!-- Accord données -->
        <div>
            <div class="champ">
                <label  for="accordMemb">J'accepte le stockage de mes données</label>
                <input type="checkbox" name="accordMemb" value="1" <?= isset($old['accordMemb']) ? 'checked' : '' ?> required>
                
            </div>
        </div>
        <!-- Boutons -->
        <div class="btn-se-connecter">
            <button type="submit">Créer mon compte</button>
        </div>

        <p>Vous possédez déjà un compte ? <a href="/views/backend/security/login.php" class="link">Se connecter</a></p>
    </form>

</main>

<script>
    function togglePassword(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>