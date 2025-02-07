<?php
include '../../../header.php';


$errorMessage = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'empty') {
        $errorMessage = '<div class="alert alert-danger">Le mot-clé ne peut pas être vide.</div>';
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau Mot-clé</h1>
        </div>
        <div class="col-md-12">
            <?php echo $errorMessage; ?> 
            <form action="<?php echo ROOT_URL . '/api/keywords/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="libMotCle">Nom du mot-clé</label>
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>



