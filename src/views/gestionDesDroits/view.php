<div class="container-fluid">
    <div class="row">
        <div class="col">
            <button class="btn btn-outline-success" id="addAccess"><i class="bi bi-database-fill-add"></i>
                Créer des accès</button>
            <button class="btn btn-outline-danger" id="delAccess"><i class="bi bi-database-fill-x"></i>
                Supprimer des accès</button>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#duplicateModal"><i class="bi bi-database-fill-down"></i>
                Dupliquer des accès
            </button>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                data-bs-target="#addUserModal"><i class="bi bi-database-fill-add" id="addUser"></i>
                Créer un utilisateur
            </button>
            <div id="aggrid_GESTIONDESDROITSACCESS" class="ag-theme-quartz"></div>
        </div>
    </div>
</div>

<!-- Modal duplication des droits -->
<div class="modal fade" id="duplicateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Duplication des accès</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                        <div class="mb-3">
                            <select id="usernameDuplicate" class="form-select">
                            </select>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    id="saveDuplicate">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal création d'un utilisateur -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Créer un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1" id="usernameAddUser">
                        </div>
                        <div class="mb-3">
                            <select id="agenceAddUser" class="form-select">
                            </select>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    id="saveAddUser">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>