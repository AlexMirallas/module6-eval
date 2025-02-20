<main class="container-fluid">
    <?php if(isset($_SESSION)) : ?>
        <div class="text-center alert alert-<?php echo flashType() ?>" role="alert" id="flash">
            <h2><?php echo flashTitre()  ?></h2>
            <p><?php echo flashMessage() ?></p>
        </div>
    <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-2 border-end">
            <h2 class="my-4">Bienvenue M. Admin</h2>
            <div class="list-group">
                <a href="<?php echo URL ?>" class="list-group-item list-group-item-action active" aria-current="true">
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
                                <a href="<?php echo URL . "?page=etudiant/delete&id=" . $etudiant["id"] ?>"  class="btn btn-outline-danger text-black" onclick="return confirm('Etes vous sûr de vouloir supprimmer?')">Supprimer</a>
                            </td>
                        </tr>
                        </a>
                    <?php endforeach; ?>
                </tbody>
            </table>   
        </div>
    </div>
</main>
