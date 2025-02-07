<?php
include '../../../header.php';

$motcles = sql_select("MOTCLE", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Mot Clé</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom des mots clés</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($motcles as $motcle) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($motcle['numMotCle'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars_decode($motcle['libMotCle'], ENT_QUOTES); ?></td>
                            <td>
                                <a href="edit.php?numMotCle=<?php echo $motcle['numMotCle']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numMotCle=<?php echo $motcle['numMotCle']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
<?php
include '../../../footer.php';
?>
