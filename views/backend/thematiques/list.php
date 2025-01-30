<?php
include '../../../header.php';

$thematiques = sql_select("THEMATIQUE", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Thématique</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom des thématiques</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($thematiques as $thematique) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($thematique['numThem'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars_decode($thematique['libThem'], ENT_QUOTES); ?></td>
                            <td>
                                <a href="edit.php?numThem=<?php echo $thematique['numThem']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numThem=<?php echo $thematique['numThem']; ?>" class="btn btn-danger">Delete</a>
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
