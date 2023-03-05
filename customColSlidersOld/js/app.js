const container = document.querySelector('.slider-container');

const progressR = document.querySelector('#red-value');
const progressG = document.querySelector('#green-value');
const progressB = document.querySelector('#blue-value');
const progressA = document.querySelector('#alpha-value');

const sliderR = document.querySelector('#red-shape');
const sliderG = document.querySelector('#green-shape');
const sliderB = document.querySelector('#blue-shape');
const sliderA = document.querySelector('#alpha-shape');

const rgba = document.querySelectorAll('.slider-value');

const val_R = document.querySelector('#val_R');
const val_G = document.querySelector('#val_G');
const val_B = document.querySelector('#val_B');
const val_A = document.querySelector('#val_A');

const display = document.querySelector('.display');
const service = document.querySelector('.service');

let r;
let g;
let b;
let a;
let val;
let m;

const styles = window.getComputedStyle(container);

const maxWidth = styles.width.slice(0, -2);
const valFactor = 255 / maxWidth;
const a_ValFactor = 100 / maxWidth;

let sliderValue = 50;

let mouseDownR = false;
let mouseDownG = false;
let mouseDownB = false;
let mouseDownA = false;

//: ALPHA click
sliderA.addEventListener('click', (e) => {
  e.preventDefault();
  sliderValue = Math.round(e.offsetX * a_ValFactor);
  a = parseFloat(`00${sliderValue}`.slice(-3)) / 100;
  changeColor('a', a);
  val_A.innerHTML = a;
  progressA.style.width = `${e.offsetX}px`;
})

//: ALPHA mousemove
sliderA.addEventListener('mousedown', (e) => {
  mouseDownA = true;
})

sliderA.addEventListener('mousemove', (e) => {
 e.preventDefault();
 if (mouseDownA == true) {
   sliderValue = Math.round(e.offsetX * a_ValFactor);
   a = sliderValue / 100;
   changeColor('a', a);
   val_A.innerHTML = a;
   progressA.style.width = `${e.offsetX}px`;
 }
})

//: ALPHA mouseup 
sliderA.addEventListener('mouseup', () => {
 mouseDownA = false;
})

//: ALPHA mousewheel
sliderA.addEventListener('wheel', (e) => {
  e.preventDefault();
  a = Math.round(parseInt(progressA.style.width.slice(0, -2)) * a_ValFactor);
  if (e.deltaY > 0 && a > 0) {
    a -= 1;
  } else if (e.deltaY < 0 && a < 100) {
    a += 1;
  }
  val_A.innerHTML = `${(a / 100).toFixed(2)}00`.slice(0, 4);
  progressA.style.width = `${Math.round(a / a_ValFactor)}px`
  a = (a / 100).toFixed(2);
  changeColor('a', a);
})

//: RED click
sliderR.addEventListener('click', (e) => {
  e.preventDefault();
  sliderValue = Math.round(e.offsetX * valFactor);
  r = `00${sliderValue}`.slice(-3);
  changeColor('r', r);
  val_R.innerHTML = r;
  progressR.style.width = `${e.offsetX}px`;
})

//: RED mousemove
sliderR.addEventListener('mousedown', (e) => {
   mouseDownR = true;
})

sliderR.addEventListener('mousemove', (e) => {
  e.preventDefault();
  if (mouseDownR == true) {
    sliderValue = Math.round(e.offsetX * valFactor);
    r = `00${sliderValue}`.slice(-3);
    changeColor('r', r);
    val_R.innerHTML = r;
    progressR.style.width = `${e.offsetX}px`;
  }
})

//: RED mouseup 
sliderR.addEventListener('mouseup', () => {
  mouseDownR = false;
})

//: RED mousewheel
sliderR.addEventListener('wheel', (e) => {
  // e.preventDefault();
  r = Math.round(parseInt(progressR.style.width.slice(0, -2)) * valFactor);
  
  if (e.deltaY > 0 && r > 0) {
    r -= 1;
  } else if (e.deltaY < 0 && r < 255) {
    r += 1;
  }
  changeColor('r', r);
  val_R.innerHTML = `00${r}`.slice(-3);
  progressR.style.width = `${Math.round(r / valFactor)}px`
})


//: GREEN click
sliderG.addEventListener('click', (e) => {
  e.preventDefault();
  sliderValue = Math.round(e.offsetX * valFactor);
  g = `00${sliderValue}`.slice(-3);
  changeColor('g', g);
  val_G.innerHTML = g;
  progressG.style.width = `${e.offsetX}px`;
})

//: GREEN mousemove
sliderG.addEventListener('mousedown', (e) => {
   mouseDownG = true;
})

sliderG.addEventListener('mousemove', (e) => {
  e.preventDefault();
  if (mouseDownG == true) {
    sliderValue = Math.round(e.offsetX * valFactor);
    g = `00${sliderValue}`.slice(-3);
    changeColor('g', g);
    val_G.innerHTML = g;
    progressG.style.width = `${e.offsetX}px`;
  }
})

//: GREEN mouseup
sliderG.addEventListener('mouseup', () => {
  mouseDownG = false;
})

//: GREEN mousewheel
sliderG.addEventListener('wheel', (e) => {
  // e.preventDefault();
  g = Math.round(parseInt(progressG.style.width.slice(0, -2)) * valFactor);
  
  if (e.deltaY > 0 && g > 0) {
    g -= 1;
  } else if (e.deltaY < 0 && g < 255) {
    g += 1;
  }
  changeColor('g', g);
  val_G.innerHTML = `00${g}`.slice(-3);
  progressG.style.width = `${Math.round(g / valFactor)}px`
})


//: BLUE click
sliderB.addEventListener('click', (e) => {
  e.preventDefault();
  sliderValue = Math.round(e.offsetX * valFactor);
  b = `00${sliderValue}`.slice(-3);
  changeColor('b', b);
  val_B.innerHTML = b;
  progressB.style.width = `${e.offsetX}px`;
})

//: BLUE mousemove
sliderB.addEventListener('mousedown', (e) => {
   mouseDownB = true;
})

sliderB.addEventListener('mousemove', (e) => {
  e.preventDefault();
  if (mouseDownB == true) {
    sliderValue = Math.round(e.offsetX * valFactor);
    b = `00${sliderValue}`.slice(-3);
    changeColor('b', b);
    val_B.innerHTML = b;
    progressB.style.width = `${e.offsetX}px`;
  }
})

//: BLUE mouseup
sliderB.addEventListener('mouseup', () => {
  mouseDownB = false;
})

//: BLUE mousewheel
sliderB.addEventListener('wheel', (e) => {
  // e.preventDefault();
  b = Math.round(parseInt(progressB.style.width.slice(0, -2)) * valFactor);
  
  if (e.deltaY > 0 && b > 0) {
    b -= 1;
  } else if (e.deltaY < 0 && b < 255) {
    b += 1;
  }
  changeColor('b', b);
  val_B.innerHTML = `00${b}`.slice(-3);
  progressB.style.width = `${Math.round(b / valFactor)}px`
})

const changeColor = (color, val) => {
  switch (color) {
    case 'r':
      r = val;
      break;
    case 'g':
      g = val;
      break;
    case 'b':
      b = val;
      break;
    case 'a':
      a = val;
      break;
  }

  const xr = `0${parseInt(r).toString(16)}`.slice(-2);
  const xg = `0${parseInt(g).toString(16)}`.slice(-2);
  const xb = `0${parseInt(b).toString(16)}`.slice(-2);
  const xa = `0${parseInt(a * 255).toString(16)}`.slice(-2);

  display.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${a}`;
  service.innerHTML = `rgba(${r}, ${g}, ${b}, ${a})   #${xr}${xg}${xb}${xa}`
}

(() => {
  r = Math.floor(Math.random() * 256);
  g = Math.floor(Math.random() * 256);
  b = Math.floor(Math.random() * 256);
  a = 1.00;
  
  changeColor('r', r);
  val_R.innerHTML = `00${r}`.slice(-3);
  progressR.style.width = `${r / valFactor}px`;
  
  changeColor('g', g);
  val_G.innerHTML = `00${g}`.slice(-3);
  progressG.style.width = `${g / valFactor}px`;
  
  changeColor('b', b);
  val_B.innerHTML = `00${b}`.slice(-3);
  progressB.style.width = `${b / valFactor}px`;

  changeColor('a', a);
  val_A.innerHTML = `${a.toFixed(2)}`;
  progressA.style.width = `${a / a_ValFactor * 100}px`;
  
})()
