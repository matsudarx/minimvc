<div class="container h-100">
    <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
            <div class="text-left my-4">
                <img src="./assets/img/logo.svg" alt="logo" width="400">
            </div>
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <h1 class="fs-4 card-title fw-bold mb-4"><?php echo $_SERVER["SERVER_NAME"]; ?> v3.1</h1>
                    <form method="POST" class="needs-validation" novalidate="" autocomplete="off" id="formLogin">
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="usernameLogin">Nom d'utilisateur</label>
                            <input type="text" class="form-control" name="usernameLogin" value="" required autofocus>
                            <div class="invalid-feedback">
                                Utilisateur invalide
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="passwordLogin">Mots de passe</label>
                            </div>
                            <input type="password" class="form-control" name="passwordLogin" required>
                            <div class="invalid-feedback">
                                Un mots de passe est requis
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-success ms-auto"><i class="bi bi-door-open"></i>
                                Connexion
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class=" text-center mt-5 text-muted">
                2019-<?php echo date('Y'); ?>
            </div>
        </div>
    </div>
</div>