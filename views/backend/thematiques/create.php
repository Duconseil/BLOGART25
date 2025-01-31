<?php
include '../../../header.php';

$errorMessage = '';
// Vérification de l'existence d'une erreur dans l'URL
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'empty') {
        $errorMessage = '<div class="alert alert-danger">Le mot-clé ne peut pas être vide.</div>';
    }
}
?>

<!-- Bootstrap form to create a new thématique -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouvelle Thématique</h1>
        </div>
        <div class="col-md-12">
            <?php echo $errorMessage; ?>
            <!-- Form to create a new thématique -->
            <form action="<?php echo ROOT_URL . '/api/thematiques/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom de la thématique</label>
                    <input id="libThem" name="libThem" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer la création ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
