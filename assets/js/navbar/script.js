let logout = document.querySelector("#logout")

logout.addEventListener("click", function (e) {
    fetch('/index.php', {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            app: 'login',
            action: 'logout'
        }),
    })
        .then(response => response.json())
        .then((data) => {
            window.location.reload();
        })
});