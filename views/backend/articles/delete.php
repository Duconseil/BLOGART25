<?php
include '../../../header.php';

// Vérifie si l'ID de l'article est passé en paramètre via la méthode GET.
if (isset($_GET['numArt'])) {
    // Récupère l'ID de l'article depuis l'URL.
    $numArt = $_GET['numArt'];
    // Récupère les informations de l'article à partir de la base de données en fonction de l'ID.
    $articles = sql_select("ARTICLE", "*", "numArt = $numArt")[0];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Titre de la page -->
            <h1>Suppression de l'article</h1>
        </div>
        <div class="col-md-12">
            <!-- Formulaire de suppression de l'article -->
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php' ?>" method="post">
                <div class="form-group">
                    <!-- Champ masqué pour l'ID de l'article -->
                    <label for="numArt">ID de l'article</label>
                    <input id="numArt" name="numArt" class="form-control" style="display: none" type="text" value="<?php echo ($numArt); ?>" readonly="readonly" />

                    <!-- Affiche la date de création de l'article -->
                    <label for="dtCreaArt">Date création</label>
                    <input id="dtCreaArt" name="dtCreaArt" class="form-control" type="text" value="<?php echo ($articles['dtCreaArt']); ?>" readonly="readonly" />

                    <!-- Affiche la date de mise à jour de l'article -->
                    <label for="dtMajArt">Date mise à jour</label>
                    <input id="dtMajArt" name="dtMajArt" class="form-control" type="text" value="<?php echo ($articles['dtMajArt']); ?>" readonly="readonly" />

                    <!-- Affiche le titre de l'article -->
                    <label for="libTitrArt">Titre</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo ($articles['libTitrArt']); ?>" readonly="readonly" />

                    <!-- Affiche le chapeau de l'article -->
                    <label for="libChapoArt">Chapeau</label>
                    <input id="libChapoArt" name="libChapoArt" class="form-control" type="text" value="<?php echo ($articles['libChapoArt']); ?>" readonly="readonly" />

                    <!-- Affiche l'arroche de l'article -->
                    <label for="libArrochArt">Arroche</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" value="<?php echo ($articles['libAccrochArt']); ?>" readonly="readonly" />

                    <!-- Affiche le premier paragraphe de l'article -->
                    <label for="parag1Art">Paragraphe 1</label>
                    <input id="parag1Art" name="parag1Art" class="form-control" type="text" value="<?php echo ($articles['parag1Art']); ?>" readonly="readonly" />

                    <!-- Affiche le sous-titre du premier paragraphe -->
                    <label for="libSsTitr1Art">Sous titre 1</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" value="<?php echo ($articles['libSsTitr1Art']); ?>" readonly="readonly" />

                    <!-- Affiche le deuxième paragraphe de l'article -->
                    <label for="parag2Art">Paragraphe 2</label>
                    <input id="parag2Art" name="parag2Art" class="form-control" type="text" value="<?php echo ($articles['parag2Art']); ?>" readonly="readonly" />

                    <!-- Affiche le sous-titre du deuxième paragraphe -->
                    <label for="libSsTitr2Art">Sous titre 2</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" value="<?php echo ($articles['libSsTitr2Art']); ?>" readonly="readonly" />

                    <!-- Affiche le troisième paragraphe de l'article -->
                    <label for="parag3Art">Paragraphe 3</label>
                    <input id="parag3Art" name="parag3Art" class="form-control" type="text" value="<?php echo ($articles['parag3Art']); ?>" readonly="readonly" />

                    <!-- Affiche la conclusion de l'article -->
                    <label for="libConclArt">Conclusion</label>
                    <input id="libConclArt" name="libConclArt" class="form-control" type="text" value="<?php echo ($articles['libConclArt']); ?>" readonly="readonly" />

                    <!-- Affiche l'URL de la photo associée à l'article -->
                    <label for="urlPhotArt">URL Photo</label>
                    <input id="urlPhotArt" name="urlPhotArt" class="form-control" type="text" value="../../../src/uploads/<?php echo str_replace("jpg", "png", $articles['urlPhotArt']); ?>" readonly="readonly" />

                    <!-- Affiche la thématique associée à l'article -->
                    <label for="libThem">Thématique</label>
                    <input id="libThem" name="libThem" class="form-control" type="text" value="<?php echo ($articles['libThem']); ?>" readonly="readonly" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <!-- Message d'avertissement pour prévenir l'utilisateur de la suppression définitive -->
                    <p style="color:red"><i><strong>Attention : </strong>La suppression de cet article sera définitive.</i></p>
                    <!-- Bouton pour confirmer la suppression -->
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</div>
