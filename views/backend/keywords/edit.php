<?php
include '../../../header.php';

if (isset($_GET['numMotCle'])) {
    $numMotCle = $_GET['numMotCle'];
    // Fetch the keyword details from the database
    $motcle = sql_select("MOTCLE", "*", "numMotCle = $numMotCle")[0];
    $libMotCle = $motcle['libMotCle'];
} else {
    $numMotCle = '';
    $libMotCle = '';
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Mot clé</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to update a keyword -->
            <form action="<?php echo ROOT_URL . '/api/keywords/update.php'; ?>" method="POST">
                <div class="form-group">
                    <label for="libMotCle">Libellé</label>
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text" value="<?php echo htmlspecialchars($libMotCle, ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
                <br />
                <input type="hidden" name="numMotCle" value="<?php echo htmlspecialchars($numMotCle, ENT_QUOTES, 'UTF-8'); ?>" />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer update ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include '../../../footer.php';
?>
