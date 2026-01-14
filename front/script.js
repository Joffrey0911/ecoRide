
const btn_profil = document.getElementById('modify_profil');
const btn_ajouter = document.getElementById('btn_ajouter');
const formulaire = document.getElementById('zone_formulaire');

const photo = document.getElementById('btn_photo');
const vehicule = document.getElementById('btn_car');

const profilzone = document.getElementById('zone_profil');
const photozone = document.getElementById('zone_photo');
const photoform = document.getElementById('form_photo');
const containerBio = document.getElementById('bio_container');

const selectRole = document.getElementById('role');
const btnValider = document.getElementById('btn_valider');

const btnValiderBio = document.getElementById('btn_valider_bio');


const zoneBio = document.getElementById('zone_biographie');


const formBio = document.getElementById('form_bio');
const boutonBio = document.getElementById('btn_bio');
const saisie_vehicule = document.getElementById('saisie_vehicule');
const champsVehicule = ['immat', 'immat_date', 'modele', 'mark', 'color', 'nb_place'];
const formVehicule = document.getElementById('form_vehicule');
const zoneVehicule = document.getElementById('zone_vehicule');
const messageRequired = document.getElementById('message_required');
const zoneaffichage = document.getElementById('zone_affichage');
const searchTravel = document.getElementById('search_travel');
const messageError = document.getElementById('Error_Message');
const message = document.createElement('p');
const messageCovoiturage = document.getElementById('messageCovoit');
const elements = searchTravel.querySelectorAll('input, select');
let formIsOk = true;


function verifForm(){
 elements.forEach(el =>{
  if (el.value.trim() ===''){
    formIsOk = false;
    el.style.border = '2px solid red';
  

  }else{
    formIsOk = true;
    el.style.border = '';
  }
 });

};








// Fonction pour cacher toutes les zones dynamiques
function hideAllZones() {
    zone_statut.style.display = 'none';
    formulaire.style.display = 'none';
    photozone.style.display = 'none';
    zoneBio.style.display = 'none';
    zoneVehicule.style.display = 'none';

    
}



// Toggle affichage zone profil
btn_profil.addEventListener('click', function () {
    const visible = profilzone.style.display === "block";
    hideAllZones();
    
    profilzone.style.display = visible ? 'none' : 'block';
    

    const displayState = visible ? 'none' : 'inline-block';
    btn_ajouter.style.display = displayState;
    photo.style.display = displayState;
    vehicule.style.display = displayState;
    
});

//Clic sur bouton 'Biographie'

boutonBio.addEventListener('click', function () {
    const visible = zoneBio.style.display === "block";
    hideAllZones();
    zoneBio.style.display = visible ? 'none' : 'block';
});

document.getElementById('btn_valider_bio').addEventListener('click', () => {
    
});

const textareaBio = document.getElementById('exampleFormControlTextarea1');

textareaBio.addEventListener('input', function () {
  if (textareaBio.value.trim().length > 0) {
    btnValiderBio.disabled = false;
  } else {
    btnValiderBio.disabled = true;
  }
});

formBio.addEventListener('submit', function (e) {
    e.preventDefault(); 
    

    const biographie = document.getElementById('exampleFormControlTextarea1').value;
  


    // Envoie la bio via fetch à PHP
    fetch('enregistrer_biographie.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'  // Envoi JSON
    },
    body: JSON.stringify({ biographie: biographie })
})
    .then(response => response.text())
    .then(data => {
       
        // Affiche la bio dans le container
        containerBio.innerHTML = biographie;
        containerBio.style.display = "inline-block";
        containerBio.style = "border: solid 2px #425279" ;


        // Optionnel : cacher le formulaire
       document.getElementById('exampleFormControlTextarea1').value = "";
       zoneBio.style.display = "none";

    })
    .catch(error => {
        console.error('Erreur :', error);
        
    });
});







// Clic sur bouton "Ajouter un covoiturage"
btn_ajouter.addEventListener('click', function () {
    const visible = formulaire.style.display === "block";
    hideAllZones();
    formulaire.style.display = visible ? 'none' : 'block';
});

// Clic sur bouton "Photo"
photo.addEventListener('click', function () {
    const visible = photozone.style.display === "block";
    hideAllZones();
    photozone.style.display = visible ? 'none' : 'block';
});


// -------------------ZONE VEHICULE---------------------//

vehicule.addEventListener('click', function(){
    const visible = zoneVehicule.style.display === "block"; 
    hideAllZones();
    zoneVehicule.style.display = visible ? 'none' : 'block';
    });



//------------------- espace photo -------------------//
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form_photo");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const fichier = document.getElementById("photo").files[0];
    if (!fichier) return;

    const formData = new FormData();
    formData.append("photo", fichier);

    fetch("upload_photo.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.text())
.then((responseText) => {
  // Recharge l'image depuis show_photo.php en forçant le cache à ignorer
  const img = document.querySelector("#picture_user img");
  img.src = "show_photo.php?t=" + new Date().getTime(); // ajoute un timestamp pour forcer le reload

  // Affiche un message dans ta div résultat
  document.getElementById("resultat_upload").innerHTML = "✅ Photo mise à jour avec succès !";
})


      .catch((err) => {
        document.getElementById("resultat_upload").innerHTML = "Erreur lors de l'envoi.";
        console.error(err);
      });
  });
});

/* ------------ESPACE ENTREE VEHICULE --------------*/

/*document.getElementById('form_vehicule').addEventListener('submit', function(e) {
  e.preventDefault();


  const formData = new FormData(this);

  fetch('ajouter_voiture.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    alert(data); 
  })
  .catch(error => {
    console.error('Erreur :', error);
  });
})
  */

/* -------------ESPACE COVOITURAGE------------------*/ 

searchTravel.addEventListener('submit', function(e) {
    e.preventDefault(); // Empêche le rechargement de la page

    const formData = new FormData(this);

    fetch('covoiturage.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Affiche le message renvoyé par PHP dans la div
        messageCovoiturage.innerHTML = data;

        // Si le message contient "succès", on reset le formulaire
        if (data.includes('succès')) {
            searchTravel.reset();
        }

        // Faire disparaître le message après 5 secondes
        setTimeout(() => {
            messageCovoiturage.innerHTML = '';
        }, 5000);
    })
    .catch(error => {
        messageCovoiturage.innerHTML = "<span style='color:red;'>Une erreur est survenue.</span>";
    });
});
