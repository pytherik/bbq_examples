const wrein = document.getElementById("width");
const hrein = document.getElementById("height");
const sub  = document.getElementById('sub');
const canv = document.getElementById('canv');
sub.addEventListener("click", (e) => {
  e.preventDefault();
  canv.setAttribute("width", wrein.value);
  canv.setAttribute("height", hrein.value);
})



