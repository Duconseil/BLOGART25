<?php
include '../../../header.php';

// Récupération des thématiques et des mots-clés depuis la base de données
$thematiques = sql_select('THEMATIQUE', '*');
$motsCles = sql_select('MOTCLE', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un article</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/create.php' ?>" method="post" enctype="multipart/form-data">
                <!-- Champ pour le titre de l'article -->
                <div class="form-group">
                    <label for="libTitrArt">Titre</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <!-- Champ pour le chapeau de l'article -->
                <div class="form-group">
                    <label for="libChapoArt">Chapeau</label>
                    <input id="libChapoArt" name="libChapoArt" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <!-- Champ pour l'accroche de l'article -->
                <div class="form-group">
                    <label for="libAccrochArt">Accroche</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br/>
                <!-- Champ pour le premier paragraphe de l'article -->
                <div class="form-group">
                    <label for="parag1Art">Paragraphe 1</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" type="text" autofocus="autofocus"></textarea>
                </div>
                <br />
                <!-- Champ pour le sous-titre du premier paragraphe -->
                <div class="form-group">
                    <label for="libSsTitr1Art">Sous titre 1</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br/>
                <!-- Champ pour le deuxième paragraphe de l'article -->
                <div class="form-group">
                    <label for="parag2Art">Paragraphe 2</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" type="text" autofocus="autofocus"></textarea>
                </div>
                <br />
                <!-- Champ pour le sous-titre du deuxième paragraphe -->
                <div class="form-group">
                    <label for="libSsTitr2Art">Sous titre 2</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br/>
                <!-- Champ pour le troisième paragraphe de l'article -->
                <div class="form-group">
                    <label for="parag3Art">Paragraphe 3</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" type="text" autofocus="autofocus"></textarea>
                </div>
                <!-- Champ pour la conclusion de l'article -->
                <div class="form-group">
                    <label for="libConclArt">Conclusion</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" type="text" autofocus="autofocus"></textarea>
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

                <!-- Liste des mots-clés -->
                <div class="form-group">
                    <label for="numMotCle">Mots-clés</label>    
                    <div class="list-group" id="motCleList">
                        <?php foreach ($motsCles as $motCle) : ?>
                            <div class="list-group-item list-group-item-action motCle-item" data-id="<?php echo $motCle['numMotCle']; ?>">
                                <?php echo $motCle['libMotCle']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="numMotCle" id="selectedMotCles" value="" />
                </div>
                <br />
                <!-- Bouton pour soumettre le formulaire et créer l'article -->
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
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
