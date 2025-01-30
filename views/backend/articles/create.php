<?php
include '../../../header.php';

// Récupération des thématiques depuis la base de données
$thematiques = sql_select('THEMATIQUE', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Titre de la page -->
            <h1>Création d'un article</h1>
        </div>
        <div class="col-md-12">
            <!-- Formulaire pour la création d'un article -->
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
                        <!-- Boucle pour afficher toutes les thématiques disponibles -->
                        <?php foreach ($thematiques as $thematique) : ?>
                            <option value="<?php echo $thematique['numThem']; ?>">
                                <?php echo $thematique['libThem']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
