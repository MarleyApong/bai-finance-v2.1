// Initialisation de tous les champs du formulaire
let Form = document.getElementById("Form");
let Nom = document.getElementById("Nom");
// let Prenom = document.getElementById("Prenom");
let Genre = document.getElementById("Genre");
let DateNais = document.getElementById("Date-Nais");
let LieuNais = document.getElementById("Lieu-Nais");
let Profession = document.getElementById("Profession");
let Idpers = document.getElementById("Id-pers");
// let Pays = document.getElementById("Pays");
let Ville = document.getElementById("Ville");
let Qtier = document.getElementById("Qtier");
let Phone = document.getElementById("Phone");
let Email = document.getElementById("Email");
let Pass = document.getElementById("Password");
let DateEmb = document.getElementById("Date-Emb");

// Mot de passe par defaut
window.onload = () => {
    Pass.value = "12341"
}
Idpers.readOnly = true;

// Renvoie dans le champ id en fonction de la saisie du nom
Nom.oninput = () => {
    RandomId();
}

// Verification control de saisie
Form.addEventListener('submit', e => {
    let NomValue = Nom.value.trim();
    let GenreValue = Genre.value;
    let DateNaisValue = DateNais.value.trim();
    let LieuNaisValue = LieuNais.value.trim();
    let ProfessionValue = Profession.value.trim();
    let VilleValue = Ville.value.trim();
    let QtierValue = Qtier.value.trim();
    let PhoneValue = Phone.value.trim();
    let EmailValue = Email.value.trim();
    let DateEmbValue = DateEmb.value.trim();
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
    // ===============Check du genre
    if (GenreValue === "") {
        Message = "Entrez le sexe !";
        M_Error(Genre, Message);
        e.preventDefault();
    }
    if (!DateNaisValue.match(/^[0-9]/)) {
        Message = "Entrez la date de naissance !";
        M_Error(DateNais, Message);
        e.preventDefault();
    }
    if (!DateEmbValue.match(/^[0-9]/)) {
        Message = "Entrez la date d'embauche !";
        M_Error(DateEmb, Message);
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
        Message = "Entrez le ville !";
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


// =============Fonction qui sera retournee en cas d'erreur

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
    let ForAdmin = "BA";
    let FirstSize = SizeInput - 1;
    // let NameRev = Nom.value.split('').reverse().join('');
    let NameRev = Nom.value.substring(FirstSize,SizeInput);
    let Name = Nom.value.substring(0,1);
    let Idp ='';
    if (TotalGroup == 5) {
        Idp = ForAdmin + Group1 + Name.toUpperCase() + Group2 + NameRev.toUpperCase();
    }  
    Idpers.value = Idp;
}

