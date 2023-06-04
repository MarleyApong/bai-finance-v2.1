// Initialisation des variables

let exit = document.querySelector(".close");
let MenuTop = document.querySelector(".Menu");
let MenuBot = document.querySelector(".MenuBot");
let Navigation = document.querySelector(".Navigation");
let Main = document.querySelector(".Main");
let NavActive = true;

// ===================On commence

MenuTop.onclick = () => {

  NavActive = false;
  Navigation.classList.toggle("show");
  Main.classList.toggle("show");

}

MenuBot.onclick = () => {
  Navigation.classList.toggle("show");
  Main.classList.toggle("show");
}


exit.onclick = () => {
  Navigation.classList.remove("show");
  Main.classList.remove("show");
}

// Main.onclick = () => {
//   Navigation.classList.remove("show");
//   // Main.classList.remove("show");
// }

// Theme color: 

let Icon_click = document.querySelector("#Icon_click");
let Bar__color = document.querySelector(".Bar__color");

let Color1 = document.querySelector(".color1");
let Color2 = document.querySelector(".color2");
let Color3 = document.querySelector(".color3");

let Local_storage = localStorage.getItem("theme");

Icon_click.onclick = () => {
  Bar__color.classList.toggle("show_color");
}

function theme1 () {
  document.documentElement.style.setProperty('--bg-primary', '#dedef0');
  document.documentElement.style.setProperty('--bg-50', '#eefae9');
  document.documentElement.style.setProperty('--color-1', '#0c2c52');
  document.documentElement.style.setProperty('--color-2', '#f3f3f3');
  document.documentElement.style.setProperty('--color-3', '#100d41');
  document.documentElement.style.setProperty('--color-4', '#0c2c52');
  document.documentElement.style.setProperty('--color-5', '#ffffff');
  document.documentElement.style.setProperty('--color-6', '#a09d9d31');
  document.documentElement.style.setProperty('--white', '#0c2c52');
  document.documentElement.style.setProperty('--color-switch2', '#fff');
  document.documentElement.style.setProperty('--color-switch3', '#fff');
  document.documentElement.style.setProperty('--bg-header', '#e1e1e1');
  document.documentElement.style.setProperty('--color-btn', '#100d41');
  document.documentElement.style.setProperty('--color-input', '#0c2c52');
  document.documentElement.style.setProperty('--color-hover', '#0d1a247c');
  document.documentElement.style.setProperty('--border-color-1', '#687b96');
  document.documentElement.style.setProperty('--border-color-2', '#3b5246');
  document.documentElement.style.setProperty('--border-color-3', '#b99797');
  document.documentElement.style.setProperty('--border-color-4', '#606677');
  document.documentElement.style.setProperty('--border-color-5', '#c4b2a4');
  document.documentElement.style.setProperty('--border-color-6', '#c2a8c0');

  document.documentElement.style.setProperty('--box-call-color', '#3b3a3a');
}

function theme2 () {
  document.documentElement.style.setProperty('--bg-primary', '#333');
  document.documentElement.style.setProperty('--bg-50', '#505152');
  document.documentElement.style.setProperty('--color-1', '#cac4c4');
  document.documentElement.style.setProperty('--color-2', '#e3e3f0');
  document.documentElement.style.setProperty('--color-3', '#313030');
  document.documentElement.style.setProperty('--color-4', '#ffff');
  document.documentElement.style.setProperty('--color-5', '#000');
  document.documentElement.style.setProperty('--white', '#fff');
  document.documentElement.style.setProperty('--color-switch', '#fff');
  document.documentElement.style.setProperty('--color-switch2', '#333');
  document.documentElement.style.setProperty('--color-switch3', '#333');
  document.documentElement.style.setProperty('--color-6', '#333');
  document.documentElement.style.setProperty('--bg-header', '#4b4848');
  document.documentElement.style.setProperty('--color-btn', '#e8e7f0');
  document.documentElement.style.setProperty('--color-input', '#64676b');
  document.documentElement.style.setProperty('--color-hover', '#0d1a247c');
  document.documentElement.style.setProperty('--border-color-1', '#333');
  document.documentElement.style.setProperty('--border-color-2', '#333');
  document.documentElement.style.setProperty('--border-color-3', '#333');
  document.documentElement.style.setProperty('--border-color-4', '#333');
  document.documentElement.style.setProperty('--border-color-5', '#333');
  document.documentElement.style.setProperty('--border-color-6', '#333');
  document.documentElement.style.setProperty('--box-call-color', '#3b3a3a');
}

function theme3 () {
  document.documentElement.style.setProperty('--bg-primary', '#0a7713');
  document.documentElement.style.setProperty('--bg-50', '#128b4d');
  document.documentElement.style.setProperty('--color-1', '#318052');
  document.documentElement.style.setProperty('--color-2', '#e3e3f0');
  document.documentElement.style.setProperty('--color-3', '#1f3f1f');
  document.documentElement.style.setProperty('--color-4', '#ffff');
  document.documentElement.style.setProperty('--color-5', '#fff');
  document.documentElement.style.setProperty('--color-5', '#fff');
  document.documentElement.style.setProperty('--white', '#fff');
  document.documentElement.style.setProperty('--color-switch', '#fff');
  document.documentElement.style.setProperty('--color-switch2', '#1f3f1f');
  document.documentElement.style.setProperty('--color-switch3', '#0a7713');
  document.documentElement.style.setProperty('--color-6', '#0a7713');
  document.documentElement.style.setProperty('--bg-header', '#f1f1f1');
  document.documentElement.style.setProperty('--color-btn', '#13410d');
  document.documentElement.style.setProperty('--color-input', '#0c5235');
  document.documentElement.style.setProperty('--color-hover', '#0d24157c');
  document.documentElement.style.setProperty('--border-color-1', '#687b96');
  document.documentElement.style.setProperty('--border-color-2', '#3b5246');
  document.documentElement.style.setProperty('--border-color-3', '#b99797');
  document.documentElement.style.setProperty('--border-color-4', '#606677');
  document.documentElement.style.setProperty('--border-color-5', '#c4b2a4');
  document.documentElement.style.setProperty('--border-color-6', '#c2a8c0');

  document.documentElement.style.setProperty('--box-call-color', '#1f3f1f');
}

Color1.onclick = () => {
  theme1 ()
  localStorage.setItem("theme","color1");
}

Color2.onclick = () => {
  theme2 ()
  localStorage.setItem("theme","color2");
}

Color3.onclick = () => {
  theme3 ()
  localStorage.setItem("theme","color3");
}

if (Local_storage === 'color2') {
  theme2 ()
}
else if (Local_storage === 'color3') {
  theme3 ()
}
else {
  theme1 ()
}