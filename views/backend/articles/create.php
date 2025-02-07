<?php
require_once '../../../header.php';

$thematiques = sql_select('THEMATIQUE', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau Article</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/create.php' ?>" method="post" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="libStat">Titre</label>
                    <input id="titre" name="libTitrArt" class="form-control" type="text" autofocus="autofocus" placeholder="Sur 100 car.">
                    <br>
                    <label for="libStat">Date création</label>
                    <input id="Datecreation" name="dtCreaArt" class="form-control" type="datetime-local" autofocus="autofocus" placeholder="jj/mm/aaaa">
                    <br>
                    <label for="libStat">Chapeau</label>
                    <textarea id="Chapeau" name="libChapoArt" class="form-control" placeholder="Décrivez le chapeau. Sur 500 caractères." maxlength="500" style="height: 200px;"></textarea>
                    <br>
                    <label for="libStat">Accroche paragraphe 1</label>
                    <input id="Accroche1" name="libAccrochArt" class="form-control" type="text" autofocus="autofocus" maxlength="100" placeholder="">
                    <br>sur 100 car.
                    <label for="libStat">Paragraphe 1</label>
                    <textarea id="Paragraphe1" name="parag1Art" class="form-control" placeholder="Décrivez le premier paragraphe. Sur 1200 car." maxlength="1200" style="height: 200px;"></textarea>
                    <br>
                    <label for="libStat">Sous-titre 1</label>
                    <input id="Soustitre1" name="libSsTitr1Art" class="form-control" type="text" autofocus="autofocus" maxlength="100" placeholder="Sur 100 car.">
                    <br>
                    <label for="libStat">Paragraphe 2</label>
                    <textarea id="Paragraphe2" name="parag2Art" class="form-control" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car." maxlength="1200" style="height: 200px;"></textarea>
                    <br>
                    <label for="libStat">Sous-titre 2</label>
                    <input id="Soustitre2" name="libSsTitr2Art" class="form-control" type="text" autofocus="autofocus" maxlength="100" placeholder="Sur 100 car.">
                    <br>
                    <label for="libStat">Paragraphe 3</label>
                    <textarea id="Paragraphe3" name="parag3Art" class="form-control" placeholder="Décrivez le troisième paragraphe. Sur 1200 car." maxlength="1200" style="height: 200px;"></textarea>
                    <br>
                    <label for="libStat">Conclusion</label>
                    <textarea id="Conclusion" name="libConclArt" class="form-control" placeholder="Décrivez la conclusion. Sur 800 car." maxlength="500" style="height: 200px;"></textarea>
                    <br>

                    <label for="urlPhotArt">Choisir une image :</label>
                    <input type="file" id="urlPhotArt" name="urlPhotArt" accept=".jpg, .jpeg, .png, .gif" class="form-control" maxlength="80000" size="200000000000">
                    <p>>> Extension des images acceptées : .jpg, .gif, .png, .jpeg (largeur, hauteur, taille max : 80000px, 80000px, 200 Mo)</p>
                    <br>

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
                <br>

                <div class="form-group mt-2" style="margin: 32px auto 128px;">
                    <button type="submit" class="btn btn-primary">Confirmer création ?</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>
