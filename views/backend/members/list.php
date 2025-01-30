<?php
include '../../../header.php'; // Contient l'en-tête et appelle config.php

// Charger tous les membres
$membres = sql_select("MEMBRE", "*");

// Charger tous les statuts
$statuts = sql_select("STATUT", "*");

// Création d'un tableau associatif pour associer les numéros de statut aux noms
$statuts_assoc = [];
foreach ($statuts as $statut) {
    $statuts_assoc[$statut['numStat']] = $statut['libStat'];
}
?>

<!-- Mise en page Bootstrap pour afficher tous les membres -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Accord RGPD</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($membres as $membre) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($membre['numMemb']); ?></td>
                            <td><?php echo htmlspecialchars($membre['nomMemb']); ?></td>
                            <td><?php echo htmlspecialchars($membre['prenomMemb']); ?></td>
                            <td><?php echo htmlspecialchars($membre['pseudoMemb']); ?></td>
                            <td><?php echo htmlspecialchars($membre['eMailMemb']); ?></td>
                            <td><?php echo $membre['accordMemb'] ? 'Oui' : 'Non'; ?></td>
                            <td>
                                <?php 
                                    // Afficher le nom du statut ou "Inconnu" si non trouvé
                                    echo isset($statuts_assoc[$membre['numStat']]) ? 
                                        htmlspecialchars($statuts_assoc[$membre['numStat']]) : 
                                        'Inconnu'; 
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-danger">Delete</a>
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
include '../../../footer.php'; // Contient le pied de page
?>
