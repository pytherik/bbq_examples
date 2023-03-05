const red = document.getElementById("red");
const green = document.getElementById("green");
const blue = document.getElementById("blue");

const canv = document.getElementById("canv");
let ctx = canv.getContext("2d");

let r = red.value;
let g = green.value;
let b = blue.value;

var outputR = document.getElementById("outR");
var outputG = document.getElementById("outG");
var outputB = document.getElementById("outB");


red.oninput = function () {
  r = this.value;
  let rval = `00${r}`.slice(-3);
  outputR.innerHTML = `R : ${rval}`;
  changeColor('r', r);
}

green.oninput = function () {
  g = this.value;
  let gval = `00${g}`.slice(-3);
  outputG.innerHTML = `G : ${gval}`;
  changeColor('g', g);
}

blue.oninput = function () {
  b = this.value;
  let bval = `00${b}`.slice(-3);
  outputB.innerHTML = `B : ${bval}`;
  changeColor('b', b);
}


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
  }
  ctx.beginPath();
  ctx.rect(0, 0, 400, 400);
  ctx.fillStyle = (`rgba(${r}, ${g}, ${b}, 1)`);
  ctx.fill();
  }
  
(() => {
  
  r = Math.floor(Math.random() * 255);
  let rval = `00${r}`.slice(-3);
  red.value = r;
  outputR.innerHTML = `R : ${rval}`;
  changeColor('r', r);
  
  g = Math.floor(Math.random() * 255);
  let gval = `00${g}`.slice(-3);
  green.value = g;
  outputG.innerHTML = `G : ${gval}`;
  changeColor('g', g);

  b = Math.floor(Math.random() * 255);
  let bval = `00${b}`.slice(-3);
  blue.value = b;
  outputB.innerHTML = `B : ${bval}`;
  changeColor('b', b);
})()
    