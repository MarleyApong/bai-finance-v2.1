// Initialisation de tous les champs du formulaire
let Form = document.getElementById("Form");
let Start = document.getElementById("start");
let Nom = document.getElementById("Nom");
let Prenom = document.getElementById("Prenom");
let Genre = document.getElementById("Genre");
let DateNais = document.getElementById("Date-Nais");
let LieuNais = document.getElementById("Lieu-Nais");
let Profession = document.getElementById("Profession");
let Idclt = document.getElementById("Id-clt");
// let Pays = document.getElementById("Pays");
let Ville = document.getElementById("Ville");
let Qtier = document.getElementById("Qtier");
let Phone = document.getElementById("Phone");
let Email = document.getElementById("Email");
let Pass = document.getElementById("Password");

let Chk1 = document.getElementById("Chk1");
let Chk2 = document.getElementById("Chk2");
let Chk3 = document.getElementById("Chk3");
let SodeT = document.getElementById("SodeT");
let SodeE = document.getElementById("SodeE");
let SodeA = document.getElementById("SodeA");

// Mot de passe par defaut
window.onload = () => {
    Pass.value = "1234"
    Idclt.value.readOnly = true;
}

// Renvoie dans le champ id en fonction de la saisie du nom
Nom.oninput = () => {
    RandomId();
}
// Verification control de saisie
Form.addEventListener('submit', e => {
    let NomValue = Nom.value.trim();
    // let PrenomValue = Prenom.value.trim();
    let GenreValue = Genre.value;
    let DateNaisValue = DateNais.value.trim();
    let LieuNaisValue = LieuNais.value.trim();
    let ProfessionValue = Profession.value.trim();
    let VilleValue = Ville.value.trim();
    let QtierValue = Qtier.value.trim();
    let PhoneValue = Phone.value.trim();
    let EmailValue = Email.value.trim();
    let Message = "";

    // ==================Check du champ nom
    if (NomValue === "") {
        Message = "Entrez le nom !";
        M_Error(Nom, Message);
        e.preventDefault();
    } else if (!NomValue.match(/^[a-zA-Z]/)) {
        Message = "Le nom doit commencer par une lettre !";
        M_Error(Nom, Message);
        e.preventDefault();
    }
    if (GenreValue === "") {
        Message = "Entrez le sexe !";
        M_Error(Genre, Message);
        e.preventDefault();
    }
    // ===============Check du genre
    if (!DateNaisValue.match(/^[0-9]/)) {
        Message = "Entrez la date de naissance !";
        M_Error(DateNais, Message);
        e.preventDefault();
    }
    if (LieuNaisValue === "") {
        Message = "Entrez le lieu de naissance !";
        M_Error(LieuNais, Message);
        e.preventDefault();
    }
    if (ProfessionValue === "") {
        Message = "Entrez la profession !";
        M_Error(Profession, Message);
        e.preventDefault();
    }
    if (VilleValue === "") {
        Message = "Entrez le Quartier !";
        M_Error(Ville, Message);
        e.preventDefault();
    }
    if (QtierValue === "") {
        Message = "Entrez le Quartier !";
        M_Error(Qtier, Message);
        e.preventDefault();
    }
    if (PhoneValue === "") {
        Message = "Entrez le numéro de téléphone !";
        M_Error(Phone, Message);
        e.preventDefault();
    }
    if (!EmailValue == Email_Very(EmailValue)) {
        Message = "Cet email n'est pas valide !";
        M_Error(Email, Message);
        e.preventDefault();
    }

})


// // =============Fonction qui sera retournee en cas d'erreur

function M_Error(champ, Message) {
    let Input_Box = champ.parentElement;
    let Small = Input_Box.querySelector('small');

    // Retour du message d'erreur 
    Small.innerText = Message;

    // Retour de la couleur selon l'erreur
    Input_Box.className = "Input__box Error";
}

// ===========Fonction qui sera retournee, si valide
function M_Succes(champ) {
    let Input_Box = champ.parentElement;

    // Retour de la couleur valide
    Input_Box.className = "Input__box Succes";
}

// ===========Fonction de verifaication de l'email
function Email_Very(email) {
    return /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test(email);
}


// Function pour generer l'id en fonction du nom
function RandomId() {
    let RandomNumer = crypto.getRandomValues(new Uint16Array(2))[0];
    let RandomNumer2 = crypto.getRandomValues(new Uint16Array(2))[0];
    let Group1 = RandomNumer.toString().substring(0, 3);
    let Group2 = RandomNumer2.toString().substring(1, 3);
    let TotalGroup = Group1.length + Group2.length;
    let SizeInput = Nom.value.length;
    let ForUser = "BU"
    let FirstSize = SizeInput - 1;
    // let NameRev = Nom.value.split('').reverse().join('');
    let NameRev = Nom.value.substring(FirstSize, SizeInput);
    let Name = Nom.value.substring(0, 1);
    let Id = '';
    if (TotalGroup == 5) {
        Id = ForUser + Group1 + Name.toUpperCase() + Group2 + NameRev.toUpperCase();
    }
    Idclt.value = Id;
}

// Controle de check

Chk1.onchange = () => {
    if (Chk1.checked == false) {
        SodeE.value = 0;
    }
    else {
        SodeE.value = 1000;
    }
}

Chk2.onchange = () => {
    if (Chk2.checked == false) {
        SodeT.value = 0;
    }
    else {
        SodeT.value = 1000;
    }
}

Chk3.onchange = () => {
    if (Chk3.checked == false) {
        SodeA.value = 0;
    }
    else {
        SodeA.value = 1000;
    }
}


