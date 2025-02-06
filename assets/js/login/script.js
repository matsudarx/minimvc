var loginForm = document.getElementById("formLogin");
formLogin.addEventListener("submit", onFormSubmit);

function onFormSubmit(event) {
    event.preventDefault();
    let data = new FormData(event.target);
    let username = data.get("usernameLogin");
    let password = data.get("passwordLogin");
    fetch('/index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'login',
            action: 'login',
            username: username,
            password: password,
        }),
    })
        .then(response => response.json())
        .then((data) => {
            window.location.reload();
        })
}