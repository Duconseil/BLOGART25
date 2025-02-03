<?php
include '../../../header.php';

$thematiques = sql_select('THEMATIQUE', '*');


// Vérifier si nous avons un numArt via GET
if(isset($_GET['numArt'])){
    $numArt = $_GET['numArt'];
    // Récupération des données de l'article
    $article = sql_select("ARTICLE
    INNER JOIN THEMATIQUE ON article.numThem = thematique.numThem", "*", "numArt = '$numArt'")[0];
    $dtCreaArt = $article['dtCreaArt'];
    $libTitrArt = $article['libTitrArt'];
    $libChapoArt = $article['libChapoArt'];
    $libAccrochArt = $article['libAccrochArt'];
    $parag1Art = $article['parag1Art'];
    $libSsTitr1Art = $article['libSsTitr1Art'];
    $parag2Art = $article['parag2Art'];
    $libSsTitr2Art = $article['libSsTitr2Art'];
    $parag3Art = $article['parag3Art'];
    $libConclArt = $article['libConclArt'];
    $urlPhotArt = $article['urlPhotArt'];
    $numThem = $article['numThem'];
    $libThem = $article['libThem'];
}
?>

<!-- Formulaire de modification de l'article -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Article</h1>
        </div>
        <div class="col-md-12">
            <!-- Formulaire de modification de l'article -->
            <form action="<?php echo ROOT_URL . '/api/articles/update.php' ?>" method="post" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="numArt">Numéro d'article</label>
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $numArt; ?>" readonly>
                    
                    <label for="libTitrArt">Titre</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo $libTitrArt; ?>">
                    
                    <label for="dtCreaArt">Date de création</label>
                    <input id="dtCreaArt" name="dtCreaArt" class="form-control" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($dtCreaArt)); ?>">

                    <label for="libChapoArt">Chapeau</label>
                    <textarea id="libChapoArt" name="libChapoArt" class="form-control" maxlength="500" style="height: 200px;"><?php echo $libChapoArt; ?></textarea>
                    
                    <label for="libAccrochArt">Accroche paragraphe 1</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" maxlength="100" value="<?php echo $libAccrochArt; ?>">
                    
                    <label for="parag1Art">Paragraphe 1</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" maxlength="1200" style="height: 200px;"><?php echo $parag1Art; ?></textarea>
                    
                    <label for="libSsTitr1Art">Sous-titre 1</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" maxlength="100" value="<?php echo $libSsTitr1Art; ?>">
                    
                    <label for="parag2Art">Paragraphe 2</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" maxlength="1200" style="height: 200px;"><?php echo $parag2Art; ?></textarea>
                    
                    <label for="libSsTitr2Art">Sous-titre 2</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" maxlength="100" value="<?php echo $libSsTitr2Art; ?>">
                    
                    <label for="parag3Art">Paragraphe 3</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" maxlength="1200" style="height: 200px;"><?php echo $parag3Art; ?></textarea>
                    
                    <label for="libConclArt">Conclusion</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" maxlength="500" style="height: 200px;"><?php echo $libConclArt; ?></textarea>

                    <div class="form-group">
                    <p>Image actuelle</p>
                    <img width="500px" src="<?php echo ROOT_URL . '/src/uploads/' . $urlPhotArt  ?>">
                    <label for="urlPhotArt">Modifier l'image</label>
                    <input type="file" name="urlPhotArt" class="form-control" id="urlPhotArt" accept="image/*">
                </div>
                <br>

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
                <br>

 <!-- Choix des mots-clés -->
 <div class="form-group">
                    <label>Choisissez les mots-clés liés à l'article :</label>
                    <div class="row">
                        <div class="col-md-5">
                            <select name="addMotCle" id="addMotCle" class="form-control" size="5">
                                <?php
                                $result = sql_select('MOTCLE');
                                foreach ($result as $req) {
                                    echo '<option id="mot" value="' . $req['numMotCle'] . '">' . $req['libMotCle'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select id="newMotCle" name="motCle[]" class="form-control" size="5" multiple>
                            </select>
                        </div>
                    </div>
                </div>
                <br />

                    <script>
                        const addMotCle = document.getElementById('addMotCle');
                        const newMotCle = document.getElementById('newMotCle');
                        addMotCle.addEventListener('click', (e) => {
                            if (e.target.tagName === "OPTION") {
                                newMotCle.appendChild(e.target);
                            }
                        });
                        newMotCle.addEventListener('click', (e) => {
                            if (e.target.tagName === "OPTION") {
                                addMotCle.appendChild(e.target);
                            }
                        });
                    </script>
                </div>

                <!-- Bouton de soumission -->
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer update ?</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../../footer.php'; ?>

