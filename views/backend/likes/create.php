<?php
include '../../../header.php';
?>

<!-- Bootstrap form to create a new like -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création Nouveau Like</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new like -->
            <form action="<?php echo ROOT_URL . '/api/likes/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="numArt">Article</label>
                    <input id="numArt" name="numArt" class="form-control" type="text" required />
                </div>
                <div class="form-group">
                    <label for="numMemb">Numéro d'utilisateur</label>
                    <input id="numMemb" name="numMemb" class="form-control" type="text" required />
                </div>
                <div class="form-group">
                    <label for="likeA">Like</label>
                    <select id="likeA" name="likeA" class="form-control" required>
                        <option value="1">Like</option>
                        <option value="0">Dislike</option>
                    </select>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer Create</button>
                </div>
            </form>
        </div>
    </div>
</div>