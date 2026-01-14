<?php 
$isLoggedIn = isset($_SESSION['utilisateur_id']);
?> 


    

<div class="container-fluid">
    <header class="d-flex flex-row justify-content-between align-items-center p-3">
        <!-- Logo et texte EcoRide -->
        <div class="d-flex align-items-center" id="logo_ecoride">
            <img src="../docs/images/voiture.png" alt="logo ecoride">
            <p class="ms-5 mb-0" id="title">EcoRide</p>
            <img src="../docs/images/mdi_leaf.png" id="leaf" alt="icone de feuille">
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <!-- Bouton hamburger -->
                <button class="navbar-toggler text-white border-0" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#navbarNavEspace" 
                        aria-controls="navbarNavEspace" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation">
                    <i class="fas fa-bars fa-2x"></i>
                </button>

                <!-- Menu déroulant -->
                <div class="collapse navbar-collapse" id="navbarNavEspace">
                    <ul class="navbar-nav nav-fixed-width mt-5">
                        <li class="nav-item mt-1 fw-bold text-center">
                            <a class="nav-link" href="accueil.php">Accueil</a>
                        </li>
                        <li class="nav-item mt-1 fw-bold text-center">
                            <a class="nav-link" href="#">Covoiturages</a>
                        </li>
                        <li class="nav-item mt-1 fw-bold text-center">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item mt-1 fw-bold text-center">
                            <a id="logout" href="logout.php" class="nav-link">Se déconnecter</a>
                        </li>
                    </ul>
                </div>
            </div> 
        </nav>
    </header>
</div>
