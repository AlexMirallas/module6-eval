<main class="container-fluid">
    <div class=row>
        <img src="public/images/banner.png" alt="thousand sunny banner" height="200px">
    </div>
    <div class="row">
        <div class="col-12 mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="card p-3 py-4">
                        <div class="text-center my-3">
                            <h1 class="my-2 mb-0"><?php echo $etudiant[0]["nom"] . " " . $etudiant[0]["prenom"] . " #" . $etudiant[0]["id"] ?></h1>
                            <span class="btn btn-sm bg-info text-white my-2"><?php echo $etudiant[0]["specialite"]?></span>
                            <div class="px-4 mt-1">
                                <p class="d-inline-flex gap-1">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapsecv" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Afficher CV
                                    </a>
                                </p>
                                <div class="collapse" id="collapsecv">
                                    <div class="card card-body">
                                        <p class="fonts"><?php echo $etudiant[0]["cv"]?></p>
                                    </div>
                                </div>
                                <p class="d-inline-flex gap-1">
                                    <a class="btn btn-primary my-2" data-bs-toggle="collapse" href="#collapsedetails" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Afficher details
                                    </a>
                                </p>
                                <div class="collapse" id="collapsedetails">
                                    <table class="table table-striped table-light table-hover">
                                        <tr>
                                            <td>ID</td>
                                            <td><?php echo $etudiant[0]["id"]?></td>
                                        <tr>
                                            <td>Specialite</td>
                                            <td><?php echo $etudiant[0]["specialite"]?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de naissance</td>
                                            <td><?php echo $etudiant[0]["dt_naissance"]?></td>
                                        </tr>
                                        <tr>
                                            <td>Role</td>
                                            <td><?php echo isAdmin($etudiant[0]["isAdmin"])?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de mise a jour</td>
                                            <td><?php echo $etudiant[0]["dt_mis_a_jour"]?></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div>
                                <a class="btn btn-outline-primary px-4" href="mailto:<?php echo $etudiant[0]["email"]?>">Email</a>
                                <a class="btn btn-primary px-4 ms-3">Editer info</a>
                            </div>    
                        </div>  
                    </div>
                </div>
            </div>    
        </div>
    </div>

</main>
    
