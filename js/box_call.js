// Appel du sous menu en fonction de chaque box

let Bl1 = document.querySelector(".Bl1");
let Bl2 = document.querySelector(".Bl2");
let Bl3 = document.querySelector(".Bl3");

let Bx1 = document.querySelector(".Bx1");
let Bx2 = document.querySelector(".Bx2");
let Bx3 = document.querySelector(".Bx3");

Bl1.onclick = () => {
    Bx1.classList.toggle("down");
}
Bl2.onclick = () => {
    Bx2.classList.toggle("down");
}
Bl3.onclick = () => {
    Bx3.classList.toggle("down");
}