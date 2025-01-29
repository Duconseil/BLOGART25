<?php
include '../../../header.php';
?>

<!-- Bootstrap form to create a new member -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau membre</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new member -->
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" />
                </div>
                <div class="form-group"></div>
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" />
                </div>
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" />
                </div>
                <div class="form-group">
                    <label for="eMailMemb">Email</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email" />
                </div>
                <div class="form-group">
                    <label for="passMemb">Mot de passe</label>
                    <input id="passMemb" name="passMemb" class="form-control" type="password" />
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