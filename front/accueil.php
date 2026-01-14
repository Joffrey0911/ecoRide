<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    
    <title>Ecoride page d'accueil</title>
</head>
<body>
    <?php require_once 'header_accueil.php'; ?>



   
    

    <div class="container-fluid">
        <div class="row d-flex justify-content-center justify-content-md-between align-items-stretch mx-auto">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mx-auto  order-1 order-md-1" id="presentation">
                <p> EcoRide est une entreprise innovante spécialisée dans le covoiturage écologique, née de la volonté de réduire 
                    l'impact environnemental de nos déplacements quotidiens. Grâce à une application intuitive et accessible à tous, 
                    EcoRide propose une nouvelle manière de se déplacer, plus responsable, plus économique, et plus humaine.
                    Notre mission est claire : limiter les émissions de gaz à effet de serre en favorisant le partage des trajets entre particuliers, 
                    que ce soit pour le travail, les loisirs ou les déplacements longue distance. En mutualisant les trajets, nous réduisons le nombre de 
                    véhicules sur les routes, diminuons la pollution, et participons activement à la transition écologique. 
                    Avec EcoRide, chaque trajet compte pour la planète. Moins de voitures, plus d'air pur.</p>

            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mx-auto order-3 order-md-2" id="searching">  <!-- order-3 en mobile et 2em en medium--> 
                <form id="search_travel">
                    <div class="mb-3 input-icon-startcity">
                    <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="text" class="form-control rounded-5" id="startcity" placeholder="Ville départ">
                    </div>
                    <div class="mb-3 input-icon-endcity">
                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="text" class="form-control rounded-5" id="endcity" placeholder="Ville d'arrivée">
                    </div>
                    <div class="row gx-2 mb-3">
                        <div class="col-5 input-icon-date">
                            <i class="fa-solid fa-calendar-days"></i>

                            <input type="text" class="form-control rounded-5" id="input_date" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                        <div class="col-5 input-icon-number">
                            <i class="fa-solid fa-users"></i>
                            <input type="text" class="form-control rounded-5" id="input_number" placeholder="Nb">
                        </div>
                        <div class="col-2" id="filter">
                            <div class="form-control rounded-5 d-flex justify-content-center align-items-center p-1" id="div_filter">
                                <img src="../docs/images/logo filter.png" alt="logo filtrer">
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <button type="button" class="btn btn-success rounded-5"  id="btn_validate">Rechercher un trajet</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center order-2 order-md-3 mx-auto" id="picture1">
                <img src="../docs/images/pexels-cottonbro-5080835.jpg" alt="photo de covoiturage">
            </div>
        </div>
        <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 mx-auto mt-5 mb-5 text-center" id="picture2">
            <img src="../docs/images/ampoule.jpg" alt="image ampoule">
        </div>
    </div>
</div>

    <?php  require_once 'footer.php'; ?>

    
                
                    
                    
                


        
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>