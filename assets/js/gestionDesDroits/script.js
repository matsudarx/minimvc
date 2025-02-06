var columnDefs_GESTIONDESDROITSACCESS = [
    { headerName: "id_access", field: "id_access", editable: false, cellStyle: { color: 'darkred' } },
    {
        headerName: "Accès", field: "type_name", editable: true, cellEditor: 'agRichSelectCellEditor',
        cellEditorParams: {
            values: getAllTypename(),
            allowTyping: false,
            filterList: true,
            highlightMatch: true,
            valueListMaxHeight: 220
        }
    },
    {
        headerName: "App", field: "app_name", editable: true, cellEditor: 'agRichSelectCellEditor',
        cellEditorParams: {
            values: getAllAppname(),
            allowTyping: false,
            filterList: true,
            highlightMatch: true,
            valueListMaxHeight: 220
        }
    },
    {
        headerName: "User", field: "user_uid", editable: true, cellEditor: 'agRichSelectCellEditor',
        cellEditorParams: {
            values: getAllUsername(),
            allowTyping: false,
            filterList: true,
            highlightMatch: true,
            valueListMaxHeight: 220
        }
    },
    { headerName: "Dossier", field: "folder_name", editable: false, cellStyle: { color: 'darkred' } },
    { headerName: "Date de dernière modification", field: "access_update", editable: false, cellStyle: { color: 'darkred' } },
];

var gridOptions_GESTIONDESDROITSACCESS = {
    columnDefs: columnDefs_GESTIONDESDROITSACCESS,
    defaultColDef: {
        resizable: false,
        floatingFilter: true,
        filter: 'agMultiColumnFilter',
        sortable: true
    },
    autoSizeStrategy: {
        type: 'fitCellContents'
    },
    rowSelection: 'multiple',
    enableClickSelection: true,
    onCellValueChanged: function (event) {
        if (typeof event.data.id_access !== 'undefined') {
            fetch('/index.php', {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    app: 'gestionDesDroits',
                    action: 'updateAccess',
                    idAccess: event.data.id_access,
                    typename: event.data.type_name,
                    appname: event.data.app_name,
                    username: event.data.user_uid,
                }),
            })
                .then(response => response.json())
                .then((retour) => {
                    if (retour == "Success") {
                        reloadAgGrid();
                    }
                })
        } else if (typeof event.data.type_name !== 'undefined' && typeof event.data.app_name !== 'undefined' && typeof event.data.user_uid !== 'undefined') {
            fetch('/index.php', {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    app: 'gestionDesDroits',
                    action: 'insertAccess',
                    typename: event.data.type_name,
                    appname: event.data.app_name,
                    username: event.data.user_uid,
                }),
            })
                .then(response => response.json())
                .then((retour) => {
                    if (retour == "Success") {
                        reloadAgGrid();
                    }
                })
        }
    },
}

var eGridDivGESTIONDESDROITSACCESS = document.querySelector('#aggrid_GESTIONDESDROITSACCESS');
var agGridGESTIONDESDROITSACCESS = agGrid.createGrid(eGridDivGESTIONDESDROITSACCESS, gridOptions_GESTIONDESDROITSACCESS);
agGridGESTIONDESDROITSACCESS.setGridOption('rowData', []);

reloadAgGrid();
reloadUser();
reloadAgence();

function getAllUsername() {
    var users = [];
    fetch('./index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllUsername'
        }),
    })
        .then(response => response.json())
        .then((data) => {
            users = data;
        })
    return new Promise((resolve) => {
        setTimeout(() => resolve(users), 1000);
    });
}

function getAllUser() {
    fetch('./index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllUser'
        }),
    }).then(response => response.json())
        .then((data) => {
            apps = data;
        })
}

function getAllAppname() {
    var apps = [];
    fetch('./index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllAppname'
        }),
    })
        .then(response => response.json())
        .then((data) => {
            apps = data;
        })
    return new Promise((resolve) => {
        setTimeout(() => resolve(apps), 1000);
    });
}

function getAllTypename() {
    var types = [];
    fetch('./index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllTypename'
        }),
    })
        .then(response => response.json())
        .then((data) => {
            types = data;
        })
    return new Promise((resolve) => {
        setTimeout(() => resolve(types), 1000);
    });
}

function getAllFoldername() {
    var folders = [];
    fetch('./index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllFoldername'
        }),
    })
        .then(response => response.json())
        .then((data) => {
            folders = data;
        })
    return new Promise((resolve) => {
        setTimeout(() => resolve(folders), 1000);
    });
}

function getAllAgence() {
    var types = [];
    fetch('./index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllAgence'
        }),
    })
        .then(response => response.json())
        .then((data) => {
            types = data;
        })
    return new Promise((resolve) => {
        setTimeout(() => resolve(types), 1000);
    });
}

document.querySelector("#addAccess").addEventListener("click", function (e) {
    addItems(agGridGESTIONDESDROITSACCESS);
});

document.querySelector("#delAccess").addEventListener("click", function (e) {
    let rows = agGridGESTIONDESDROITSACCESS.getSelectedRows();
    agGridGESTIONDESDROITSACCESS.applyTransaction({ remove: rows });
    rows.forEach(element => {
        fetch('/index.php', {
            method: "POST",
            body: JSON.stringify({
                app: 'gestionDesDroits',
                action: 'deleteAccess',
                idAccess: element.id_access
            }),
        })
            .then(response => response.json())
            .then((data) => {

            })
    });
});

document.querySelector("#saveDuplicate").addEventListener("click", function (e) {
    let rows = agGridGESTIONDESDROITSACCESS.getSelectedRows();
    let username = document.querySelector("#usernameDuplicate").value;
    rows.forEach(element => {
        fetch('/index.php', {
            method: "POST",
            body: JSON.stringify({
                app: 'gestionDesDroits',
                action: 'duplicateAccess',
                idAccess: element.id_access,
                username: username
            }),
        })
            .then(response => response.json())
            .then((data) => {
            })
    });
    reloadAgGrid();
});

document.querySelector("#saveAddUser").addEventListener("click", function (e) {
    let username = document.querySelector("#usernameAddUser").value;
    let agence = document.querySelector("#agenceAddUser").value;

    fetch('/index.php', {
        method: "POST",
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'insertUser',
            username: username,
            agence: agence
        }),
    })
        .then(response => response.json())
        .then((data) => {
            if (data == 'Success') {
                // TODO : Reload 
            }
        })
});

function reloadAgGrid() {
    fetch('/index.php', {
        method: "POST",
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllAccess',
        }),
    })
        .then(response => response.json())
        .then((data) => {
            agGridGESTIONDESDROITSACCESS.setGridOption('rowData', data)
        })
}

function reloadUser() {
    fetch('/index.php', {
        method: "POST",
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllUsername',
        }),
    })
        .then(response => response.json())
        .then((data) => {
            let select = document.querySelector('#usernameDuplicate');
            data.forEach(element => {
                let opt = document.createElement('option');
                opt.value = element;
                opt.innerHTML = element;
                select.appendChild(opt);
            });
        })
}

function reloadAgence() {
    fetch('/index.php', {
        method: "POST",
        body: JSON.stringify({
            app: 'gestionDesDroits',
            action: 'getAllAgence',
        }),
    })
        .then(response => response.json())
        .then((data) => {
            let select = document.querySelector('#agenceAddUser');
            data.forEach(element => {
                let opt = document.createElement('option');
                opt.value = element.libelle2;
                opt.innerHTML = element.libelle2;
                select.appendChild(opt);
            });
        })
}

function createNewRowData() {
    const newData = {};
    return newData;
}

function addItems(aggrid) {
    const newItems = [createNewRowData()];
    aggrid.applyTransaction({ add: newItems, addIndex: 0 });
}