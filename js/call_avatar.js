let Avatar = document.getElementById("Avatar");
let Profil = document.getElementById("Profil");

Avatar.onclick = () => {
    Profil.click();
}

Profil.onchange = () => {
    if (Profil.files[0]) {
        let Reader = new FileReader();
        // console.log(Reader);
        Reader.onload = () => {
            Avatar.setAttribute('src',Reader.result);
        }
        Reader.readAsDataURL(Profil.files[0]);
    }
}