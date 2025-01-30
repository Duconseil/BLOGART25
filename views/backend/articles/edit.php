<?php
include '../../../header.php';

session_start();

require_once '../../../functions/ctrlSaisies.php';

// Vérifie si un identifiant d'article (numArt) a été transmis via l'URL
if(isset($_GET['numArt'])){
    // Récupère le numéro de l'article depuis l'URL
    $numArt = $_GET['numArt'];
    
    // Récupère toutes les thématiques disponibles dans la base de données
    $thematiques = sql_select('THEMATIQUE', '*');
    
    // Récupère les différentes parties de l'article (titre, chapô, accroche, paragraphes, etc.)
    $libTitrArt = sql_select("ARTICLE", "libTitrArt", "numArt = $numArt")[0]['libTitrArt'];
    $libChapoArt = sql_select("ARTICLE", "libChapoArt", "numArt = $numArt")[0]['libChapoArt'];
    $libAccrochArt = sql_select("ARTICLE", "libAccrochArt", "numArt = $numArt")[0]['libAccrochArt'];
    $parag1Art = sql_select("ARTICLE", "parag1Art", "numArt = $numArt")[0]['parag1Art'];
    $libSsTitr1Art = sql_select("ARTICLE", "libSsTitr1Art", "numArt = $numArt")[0]['libSsTitr1Art'];
    $parag2Art = sql_select("ARTICLE", "parag2Art", "numArt = $numArt")[0]['parag2Art'];
    $libSsTitr2Art = sql_select("ARTICLE", "libSsTitr2Art", "numArt = $numArt")[0]['libSsTitr2Art'];
    $parag3Art = sql_select("ARTICLE", "parag3Art", "numArt = $numArt")[0]['parag3Art'];
    $libConclArt = sql_select("ARTICLE", "libConclArt", "numArt = $numArt")[0]['libConclArt'];
    $urlPhotArt = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArt")[0]['urlPhotArt'];
    $numThem = sql_select("ARTICLE", "numThem", "numArt = $numArt")[0]['numThem'];
}
?>

<!-- Début de la structure HTML pour afficher le formulaire d'édition de l'article -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Editer l'article</h1>
        </div>
        <div class="col-md-12">
        <!-- Formulaire d'édition de l'article, avec méthode POST pour envoyer les données -->
        <form action="<?php echo ROOT_URL . '/api/articles/update.php?numArt=' . $numArt ?>" method="post" enctype="multipart/form-data">
            
            <!-- Champ pour le titre de l'article -->
            <div class="form-group">
                <label for="libTitrArt">Titre</label>
                <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo $libTitrArt; ?>" />
            </div>
            <br />
            
            <!-- Champ pour le chapeau de l'article -->
            <div class="form-group">
                <label for="libChapoArt">Chapeau</label>
                <input id="libChapoArt" name="libChapoArt" class="form-control" type="text" value="<?php echo $libChapoArt; ?>" />
            </div>
            <br />
            
            <!-- Champ pour l'accroche de l'article -->
            <div class="form-group">
                <label for="libAccrochArt">Accroche</label>
                <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" value="<?php echo $libAccrochArt; ?>" />
            </div>
            <br/>
            
            <!-- Champ pour le premier paragraphe -->
            <div class="form-group">
                <label for="parag1Art">Paragraphe 1</label>
                <textarea id="parag1Art" name="parag1Art" class="form-control" type="text"><?php echo $parag1Art; ?></textarea>
            </div>
            <br />
            
            <!-- Champ pour le premier sous-titre -->
            <div class="form-group">
                <label for="libSsTitr1Art">Sous titre 1</label>
                <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" value="<?php echo $libSsTitr1Art; ?>" />
            </div>
            <br/>
            
            <!-- Champ pour le deuxième paragraphe -->
            <div class="form-group">
                <label for="parag2Art">Paragraphe 2</label>
                <textarea id="parag2Art" name="parag2Art" class="form-control" type="text"><?php echo $parag2Art; ?></textarea>
            </div>
            <br />
            
            <!-- Champ pour le deuxième sous-titre -->
            <div class="form-group">
                <label for="libSsTitr2Art">Sous titre 2</label>
                <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" value="<?php echo $libSsTitr2Art; ?>" />
            </div>
            <br/>
            
            <!-- Champ pour le troisième paragraphe -->
            <div class="form-group">
                <label for="parag3Art">Paragraphe 3</label>
                <textarea id="parag3Art" name="parag3Art" class="form-control" type="text"><?php echo $parag3Art; ?></textarea>
            </div>
            
            <!-- Champ pour la conclusion de l'article -->
            <div class="form-group">
                <label for="libConclArt">Conclusion</label>
                <textarea id="libConclArt" name="libConclArt" class="form-control" type="text"><?php echo $libConclArt; ?></textarea>
            </div>
            
            <!-- Affiche l'image actuelle de l'article -->
            <div class="form-group">
                <p>Image actuelle</p>
                <img width="500px" src="<?php echo ROOT_URL . '/src/uploads/' . $urlPhotArt  ?>">
                
                <!-- Permet de changer l'image -->
                <label for="urlPhotArt">Modifier l'image</label>
                <input type="file" name="urlPhotArt" class="form-control" id="urlPhotArt" accept="image/*">
            </div>
        
            <!-- Champ pour choisir la thématique de l'article -->
            <div class="form-group">
                <label for="numThem">Thématique</label>    
                <select class="form-select" name="numThem">
                    <?php 
                    // Parcourt chaque thématique et sélectionne celle qui est déjà assignée à l'article
                    foreach ($thematiques as $thematique) : ?>
                        <?php 
                            $selectedThematique = $numThem;
                            // Vérifie si la thématique de l'article est la même que celle actuelle
                            $selected = ($thematique['numThem'] == $selectedThematique) ? 'selected' : ''; 
                        ?>
                        <!-- Affiche la thématique avec la sélection correspondante -->
                        <option value="<?php echo $thematique['numThem']; ?>" <?php echo $selected; ?>>
                            <?php echo $thematique['libThem']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br/>
            
            <!-- Bouton pour soumettre le formulaire et confirmer les modifications -->
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Confirmer modification ?</button>
            </div>
        </form>
        </div>
    </div>
</div>
