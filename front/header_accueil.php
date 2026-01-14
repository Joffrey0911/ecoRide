<?php

session_start();

?>
<div class="container-fluid">
    <header class="d-flex justify-content-between align-items-center p-3">

        <!-- Logo -->
        <div class="d-flex align-items-center" id="logo_ecoride">
            <img src="../docs/images/voiture.png" alt="logo ecoride">
            <p class="ms-4 mb-0 d-none d-lg-block" id="title">EcoRide</p>
            <img src="../docs/images/mdi_leaf.png" class="d-none d-lg-block" id="leaf" alt="icone de feuille">
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md">

            <!-- Bouton hamburger -->
            <button class="navbar-toggler " type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars fa-2x"></i>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-1 mt-2">

                    <li class="nav-item fw-bold text-center d-md-none">
                        <a class="nav-link" href="inscription.php">Inscription / Connexion</a>
                    </li>

                    <li class="nav-item fw-bold text-center">
                        <a class="nav-link" href="#">Covoiturages</a>
                    </li>

                    <li class="nav-item fw-bold text-center">
                        <a class="nav-link" href="login.php">Mon espace</a>
                    </li>

                    <li class="nav-item fw-bold text-center">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- Connexion desktop -->
         <?php if (isset($_SESSION['utilisateur_id'])): ?>
            <a href="logout.php" id='deco'class="text-decoration-none d-none d-md-block text-center text-light fw-bold">
                <i class="fa-solid fa-circle-user" id="logoutIcon"></i>
                <p class="mb-0">Déconnexion</p>
            </a>
            <?php else: ?>
    

        <a href="inscription.php" id='inscription' class="text-decoration-none d-none d-md-block text-center text-light fw-bold">
            <i class="fa-solid fa-circle-user" id="loginIcon"></i>
            <p class="mb-0">Inscription / Connexion</p>
        </a>
        <?php endif; ?>

    </header>
</div>
