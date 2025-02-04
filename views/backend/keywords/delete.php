<?php

include '../../../header.php';
$delete = 0;
$message = "";

// Vérifie si le paramètre 'numMotCle' est présent dans l'URL
if (isset($_GET['numMotCle'])) {
    // Récupère le numéro du mot clé depuis l'URL
    $numMotCle = $_GET['numMotCle'];
    
    // Sélectionne le libellé du mot clé correspondant au numéro
    $motcle = sql_select("MOTCLE", "*", "numMotCle = $numMotCle")[0];
    $libMotCle = $motcle['libMotCle'];

    // Vérifie si des articles sont associés à ce mot clé
    $hasArticles = sql_select("MOTCLEARTICLE", "COUNT(*) as count", "numMotCle = $numMotCle")[0]['count'];

    // Si des articles sont associés, la suppression est interdite (delete = 0), sinon elle est autorisée (delete = 1)
    if ($hasArticles > 0) {
        $delete = 0;
        $message = "Ce mot clé est associé à des articles et ne peut pas être supprimé.";
    } else {
        $delete = 1;
    }
} else {
    $numMotCle = '';
    $libMotCle = '';
}
?>  

<!-- Bootstrap form to delete a keyword -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Mot Clé</h1>
        </div>
        <?php if (!empty($message)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert"> <?php echo $message; ?> </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <!-- Form to delete a keyword -->
            <form action="<?php echo ROOT_URL . '/api/keywords/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libMotCle">Libellé</label>
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text" value="<?php echo htmlspecialchars($libMotCle, ENT_QUOTES, 'UTF-8'); ?>" readonly="readonly" />
                </div>
                <br />
                <input type="hidden" name="numMotCle" value="<?php echo htmlspecialchars($numMotCle, ENT_QUOTES, 'UTF-8'); ?>" />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-danger" <?php echo ($delete == 0) ? 'disabled' : ''; ?>>Confirmer delete ?</button>
                </div>
                <div class="form-group mt-2">
                    <!-- Message d'avertissement pour prévenir l'utilisateur de la suppression définitive -->
                    <p style="color:red"><i><strong>Attention : </strong>La suppression de cet article sera définitive.</i></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>
