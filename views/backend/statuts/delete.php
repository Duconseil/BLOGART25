<?php

include '../../../header.php';

$numStat = null;
$libStat = '';
$isDeletable = true;

if (isset($_GET['numStat'])) {
    $numStat = intval($_GET['numStat']);
    $libStat = sql_select("STATUT", "libStat", "numStat = $numStat")[0]['libStat'] ?? '';

    $membersLinked = sql_select("MEMBRE", "COUNT(*) as count", "numStat = $numStat")[0]['count'] ?? 0;
    $isDeletable = ($membersLinked == 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isDeletable) {
    if (isset($_POST['numStat'])) {
        $numStatToDelete = intval($_POST['numStat']);
        
        $deleteSuccess = sql_delete("STATUT", "numStat = $numStatToDelete");
        
        if ($deleteSuccess) {
            header("Location: list.php?message=Statut supprimé avec succès");
            exit;
        } else {
            $errorMessage = "Erreur lors de la suppression du statut.";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Statut</h1>
        </div>
        <div class="col-md-12">
            <?php if (!$isDeletable): ?>
                <div class="alert alert-danger" role="alert">
                    Suppression impossible : ce statut est lié à des membres. Veuillez supprimer les membres associés avant de continuer.
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="libStat">Nom du statut</label>
                    <input id="numStat" name="numStat" class="form-control" style="display: none" type="text" value="<?php echo htmlspecialchars($numStat); ?>" readonly="readonly" />
                    <input id="libStat" name="libStat" class="form-control" type="text" value="<?php echo htmlspecialchars($libStat); ?>" readonly="readonly" disabled />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Retour à la liste</a>
                    <button type="submit" class="btn btn-danger" <?php echo !$isDeletable ? 'disabled' : ''; ?>>
                        Confirmer la suppression
                    </button>
                </div>
                <div class="form-group mt-2">
                    <p style="color:red"><i><strong>Attention :</strong> La suppression de ce statut sera définitive.</i></p>
                </div>
            </form>
            <?php if (isset($errorMessage)): ?>
                <p style="color:red"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
