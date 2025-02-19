<main class="container-fluid">
    <?php if(isset($_SESSION["flash"])) :?>
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <h2 class="bg-info text-white text-center py-3 rounded">
                <?php echo flash() ?>
            </h2>
        </div>
    <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-2 border-end">
            <h2 class="my-4">Bienvenue M. Admin</h2>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                     Tout les etudiants 
                </a>
                <a href="#" class="list-group-item list-group-item-action" id="stats">Statistiques</a>
            </div>
        </div>
        <div class="col-10">
            <h2 class="my-4">Tout les etudiants de classe One Piece!</h2>
            <a href="<?php echo URL?>?page=etudiant/new" class="btn btn-primary my-3">Ajouter un etudiant</a>
            <table class="table table-striped table-light table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">Mis a jour</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($etudiants as $etudiant) : ?>
                        <a href="<?php echo URL . "?page=etudiant&id=" . $etudiant["id"] ?>">
                        <tr">
                                <th scope="row"><?php echo $etudiant["id"] ?></th>
                                <td><?php echo $etudiant["prenom"] ?></td>
                                <td><?php echo $etudiant["nom"] ?></td>
                                <td><?php echo $etudiant["email"] ?></td>
                                <td><?php echo $etudiant["dt_naissance"] ?></td>
                                <td><?php echo postedTime($etudiant["dt_mis_a_jour"]) ?></td>
                            <td>
                                <a href="<?php echo URL . "?page=etudiant&id=" . $etudiant["id"] ?>" class="btn btn-outline-info text-black">Plus de details</a>
                                <a href="<?php echo URL . "?page=etudiant/edit&id=" . $etudiant["id"] ?>" class="btn btn-outline-warning text-black">Modifier</a>
                                <a href="<?php echo URL . "?page=etudiant/delete&id=" . $etudiant["id"] ?>" class="btn btn-outline-danger text-black" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</a>
                            </td>
                        </tr>
                        </a>
                    <?php endforeach; ?>
                </tbody>
            </table>   
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Êtes-vous sûr de vouloir supprimer cet élément ? Cette action ne peut pas être annulée.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger" id="confirmDelete"><a href="<?php echo URL . "?page=etudiant/delete&id=" . $etudiant["id"] ?>">Supprimer</a></button>
                </div>
            </div>
        </div>
    </div>
</main>