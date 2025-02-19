<main class="container">
    <h1>Ajouter un nouveau etudiant</h1>
    <form class="mt-4" method="POST">
      <div class="row mb-4 ">
        <input type="text" id="id" name="id" hidden value="<?php echo $data_form["id"] ?>>
      </div>  
      <div class="row mb-4">
        <div class="col">
          <div data-mdb-input-init class="form-outline">
            <input type="text" id="prenom" class="form-control" name="prenom" required value="<?php echo $data_form["prenom"] ?>" />
            <label class="form-label" for="prenom">Prenom</label>
          </div>
        </div>
        <div class="col">
          <div data-mdb-input-init class="form-outline">
            <input type="text" id="nom" class="form-control" name="nom" required value="<?php echo $data_form["nom"] ?>"/>
            <label class="form-label" for="nom">Nom</label>
          </div>
        </div>
      </div>
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="email" class="form-control" name="email" required value="<?php echo $data_form["email"] ?>"/>
        <label class="form-label" for="email">Email</label>
      </div>
      <div class="row">
        <div class="col-6">
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="date" id="dateNaissance" class="form-control" name="dt_naissance" required value="<?php echo $data_form["dt_naissance"] ?>"/>
            <label class="form-label" for="dt_naissance">Date de naissance</label>
          </div>
        </div>
        <div class="col-6">
          <div data-mdb-input-init class="form-outline mb-4">
            <input class="form-control" id="specialite" name="specialite" value="<?php echo $data_form["specialite"] ?>"/>
            <label class="form-label" for="specialite">Specialite</label>
          </div>
        </div>
      </div>
      <div data-mdb-input-init class="form-outline mb-4">
        <textarea type="text" id="cv" class="form-control overflow-auto" name="cv" rows="6"><?php echo $data_form["cv"] ?></textarea>
        <label class="form-label" for="cv">CV <span class="text-muted">(max 65000 chars)</span></label>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="role" name="isAdmin" />
        <label class="form-check-label" for="isAdmin">is Admin?</label>
      </div>
      <button  type="submit" class="btn btn-primary btn-block mb-4">Ajoute</button>
    </form>
    <?php foreach($erreurs as $erreur) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $erreur ?>
        </div>
    <?php endforeach; ?>
</main>