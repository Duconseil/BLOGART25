<?php
include '../../../header.php';

session_start();
require_once '../../../functions/ctrlSaisies.php';

if(isset($_GET['numArt'])){
    $numArt = $_GET['numArt'];
    
    $thematiques = sql_select('THEMATIQUE', '*');
    $motsCles = sql_select('MOTCLE', '*');
    
    $articleData = sql_select("ARTICLE", "*", "numArt = $numArt")[0];

    $libTitrArt = $articleData['libTitrArt'];
    $libChapoArt = $articleData['libChapoArt'];
    $libAccrochArt = $articleData['libAccrochArt'];
    $parag1Art = $articleData['parag1Art'];
    $libSsTitr1Art = $articleData['libSsTitr1Art'];
    $parag2Art = $articleData['parag2Art'];
    $libSsTitr2Art = $articleData['libSsTitr2Art'];
    $parag3Art = $articleData['parag3Art'];
    $libConclArt = $articleData['libConclArt'];
    $urlPhotArt = $articleData['urlPhotArt'];
    $numThem = $articleData['numThem'];
    
    $articleMotsCles = sql_select("MOTCLEARTICLE", "numMotCle", "numArt = $numArt");
    $selectedMotCles = array_column($articleMotsCles, 'numMotCle');
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Editer l'article</h1>
        </div>
        <div class="col-md-12">
        <form action="<?php echo ROOT_URL . '/api/articles/update.php?numArt=' . $numArt ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="libTitrArt">Titre</label>
                <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo $libTitrArt; ?>" />
            </div>
            <br />
            <div class="form-group">
                <label for="libChapoArt">Chapeau</label>
                <input id="libChapoArt" name="libChapoArt" class="form-control" type="text" value="<?php echo $libChapoArt; ?>" />
            </div>
            <br />
            
            <div class="form-group">
                <label for="libAccrochArt">Accroche</label>
                <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" value="<?php echo $libAccrochArt; ?>" />
            </div>
            <br/>

            <div class="form-group">
                <label for="parag1Art">Paragraphe 1</label>
                <textarea id="parag1Art" name="parag1Art" class="form-control"><?php echo $parag1Art; ?></textarea>
            </div>
            <br />

            <div class="form-group">
                <label for="libSsTitr1Art">Sous titre 1</label>
                <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" value="<?php echo $libSsTitr1Art; ?>" />
            </div>
            <br/>

            <div class="form-group">
                <label for="parag2Art">Paragraphe 2</label>
                <textarea id="parag2Art" name="parag2Art" class="form-control"><?php echo $parag2Art; ?></textarea>
            </div>
            <br />

            <div class="form-group">
                <label for="libSsTitr2Art">Sous titre 2</label>
                <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" value="<?php echo $libSsTitr2Art; ?>" />
            </div>
            <br/>

            <div class="form-group">
                <label for="parag3Art">Paragraphe 3</label>
                <textarea id="parag3Art" name="parag3Art" class="form-control"><?php echo $parag3Art; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="libConclArt">Conclusion</label>
                <textarea id="libConclArt" name="libConclArt" class="form-control"><?php echo $libConclArt; ?></textarea>
            </div>

            <!-- Affiche l'image actuelle de l'article -->
            <div class="form-group">
                <p>Image actuelle</p>
                <img width="500px" src="<?php echo ROOT_URL . '/src/uploads/' . $urlPhotArt  ?>">
                
                <!-- Permet à l'utilisateur de changer l'image -->
                <label for="urlPhotArt">Modifier l'image</label>

            </div>
                <!-- Champ pour ajouter une image à l'article -->
                <div class="form-group">
                    <label for="urlPhotArt">Ajouter une image</label>
                    <input type="file" name="urlPhotArt" class="form-control" id="urlPhotArt" accept="image/*">
                </div>
                <!-- Sélecteur pour choisir la thématique de l'article -->
                <div class="form-group">
                    <label for="numThem">Thématique</label>    
                    <select class="form-select" name="numThem">
                        <?php foreach ($thematiques as $thematique) : ?>
                            <option value="<?php echo $thematique['numThem']; ?>">
                                <?php echo $thematique['libThem']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            <div class="form-group">
                <label for="numMotCle">Mots-clés</label>    
                <div class="list-group" id="motCleList">
                    <?php foreach ($motsCles as $motCle) : ?>
                        <div class="list-group-item list-group-item-action motCle-item <?php echo in_array($motCle['numMotCle'], $selectedMotCles) ? 'selected' : ''; ?>" data-id="<?php echo $motCle['numMotCle']; ?>">
                            <?php echo $motCle['libMotCle']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" name="numMotCle" id="selectedMotCles" value="<?php echo implode(',', $selectedMotCles); ?>" />
            </div>
            <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer update ?</button>
                </div>
        </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const motCleItems = document.querySelectorAll(".motCle-item");
    const selectedMotClesInput = document.getElementById("selectedMotCles");
    
    motCleItems.forEach(item => {
        item.addEventListener("click", function() {
            this.classList.toggle("selected");
            updateSelectedMotCles();
        });
    });
    
    function updateSelectedMotCles() {
        let selectedMotCles = [];
        document.querySelectorAll(".motCle-item.selected").forEach(item => {
            selectedMotCles.push(item.getAttribute("data-id"));
        });
        selectedMotClesInput.value = selectedMotCles.join(",");
    }
});
</script>

<style>
.motCle-item {
    cursor: pointer;
    user-select: none;
}
.motCle-item.selected {
    background-color: #007bff;
    color: white;
}
</style>
