<?php
include '../../../header.php';

if (isset($_GET['numThem'])) {
    $numThem = $_GET['numThem'];
    $result = sql_select("THEMATIQUE", "libThem", "numThem = $numThem");

    // Décoder l'encodage HTML stocké en base pour éviter les affichages incorrects
    $libThem = !empty($result) ? html_entity_decode($result[0]['libThem'], ENT_QUOTES, 'UTF-8') : '';
} else {
    $numThem = '';
    $libThem = '';
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Thématique</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/thematiques/update.php'; ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom de la thématique</label>
                    <input id="numThem" name="numThem" class="form-control" style="display: none" type="text" value="<?php echo htmlspecialchars($numThem, ENT_QUOTES, 'UTF-8'); ?>" readonly="readonly" />
                    <input id="libThem" name="libThem" class="form-control" type="text" value="<?php echo htmlspecialchars($libThem, ENT_NOQUOTES, 'UTF-8'); ?>"/>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer update ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
