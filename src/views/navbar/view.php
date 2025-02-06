<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid" id="navbar">
        <a class="navbar-brand" href="?app=accueil">
            <img src="./assets/img/logo.svg" alt="logo" width="150" class="d-inline-block align-top" alt="">
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item card">
                <a class="nav-link active" href="<?php echo "?app=" . $_GET["app"]; ?>"
                    target="_self"><?php echo Permissions::fromCamelcase($_GET["app"]); ?></a>
            </li>
            <?php
            $folders = Permissions::getAllFolderByUser($_SESSION['username']);
            foreach ($folders as $folder) {
                echo '<li class="nav-item dropdown">';
                echo '<a class="nav-link dropdown-toggle" role="button">' . Permissions::fromCamelcase($folder) . '</a>';
                echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                $apps = Permissions::getAllAppByFolderByUser($folder, $_SESSION['username']);
                foreach ($apps as $app) {
                    echo '<li><a class="dropdown-item" href="?app=' . $app . '" target="';
                    if ($_GET["app"] == 'accueil') {
                        echo '_self">';
                    } else {
                        echo '_blank">';
                    }
                    echo Permissions::fromCamelcase($app) . '</a></li>';
                }
                echo '</ul>';
                echo '</li>';
            }
            ?>
        </ul>
        <form class="d-flex">
            <button type="button" class="btn btn-outline-success">
                <i class="bi bi-person"></i> <?php echo $_SESSION['username'] ?></button>
            <button type="button" class="btn btn-outline-danger" id="logout">
                <i class="bi bi-door-closed"></i> Deconnexion</button>
        </form>
    </div>
</nav>