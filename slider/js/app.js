const progress = document.querySelector('.slider-value');
const slider1 = document.querySelector('.slider-shape');
const container = document.querySelector('.slider-container');
const val_1 = document.querySelector('#val_1');

const styles = window.getComputedStyle(container);
const maxWidth = styles.width.slice(0,-2);
const valFactor = 255 / maxWidth;

let sliderValue = 50;
progress.style.width = `50px`;
val_1.innerHTML = `00${sliderValue}`.slice(-3);

let mouseDown = false;

slider1.addEventListener('click', (e) => {
  e.preventDefault();
  sliderValue = Math.round(e.offsetX * valFactor);
  val_1.innerHTML = `00${sliderValue}`.slice(-3);
  progress.style.width = `${e.offsetX}px`;
})



slider1.addEventListener('mousedown', (e) => {
   mouseDown = true;
})

slider1.addEventListener('mousemove', (e) => {
  e.preventDefault();
  if (mouseDown == true) {
    sliderValue = Math.round(e.offsetX * valFactor);
    val_1.innerHTML = `00${sliderValue}`.slice(-3);
    progress.style.width = `${e.offsetX}px`;
  }
})

slider1.addEventListener('mouseup', () => {
  mouseDown = false;
})