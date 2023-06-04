// Initialisation des variables
let Form = document.getElementById("Form");
let Nom = document.getElementById("Nom_connexion");
let Pass = document.getElementById("Pwd_connexion");
let Message = "";

Form.addEventListener('submit', e => {
    let NomValue = Nom.value.trim();
    let PassValue = Pass.value.trim();
    
    // check dun id
    if (NomValue === "") {
        Message = "Entrez votre Identifiant !";
        M_Error(Message);
        e.preventDefault();
    }else if (PassValue === "") {
        Message = "Entrez votre Mot de passe !";
        M_Error(Message);
        e.preventDefault();
    }

    // =============Fonction qui sera retournee en cas d'erreur

    function M_Error(Message) {
        let Small = document.querySelector('small');

        // Retour du message d'erreur 
        Small.innerText = Message;

    }
})