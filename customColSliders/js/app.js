const rgba = document.querySelectorAll('.slider-shape');

const maxWidth = $('.slider-container').css('width').slice(0,-2);
const valFactor = 255 / maxWidth;
const a_ValFactor = 100 / maxWidth;

let mouseDown = [false, false, false, false];

//: change on click
for (let i = 0; i < rgba.length; i++) {
  let slider = rgba[i];
  slider.addEventListener('click', (e) => {
    e.preventDefault();
    const color = slider.dataset.id;
    if (color != 'A') {
      val = Math.round(e.offsetX * valFactor);
      $(`#val_${color}`).text(`00${val}`.slice(-3));
    } else {
      sliderValue = Math.round(e.offsetX * a_ValFactor);
      val = parseFloat(`00${sliderValue}`.slice(-3)) / 100;
      $('#val_A').text(val);
    }
    changeColor(color, val);
    $(`#prog${color}`).css("width",`${e.offsetX}px`);
  });
}

//: change on move
for (let i = 0; i < rgba.length; i++) {
   let slider = rgba[i];
  slider.addEventListener('mousedown', () => {
    mouseDown[i] = true;
  })

  slider.addEventListener('mousemove', (e) => {
    e.preventDefault();
    if (mouseDown[i] == true) {
      const color = slider.dataset.id;
      if (color != 'A') {
        val = Math.round(e.offsetX * valFactor);
        $(`#val_${color}`).text(`00${val}`.slice(-3));
      } else {
        val = Math.round(e.offsetX * a_ValFactor) / 100;
        $('val_A').text(val);
      }
      changeColor(color, val);
      $(`#prog${color}`).css("width", `${e.offsetX}px`);
    }
  })
  slider.addEventListener('mouseup', () => {
    mouseDown[i] = false;
  })

//: change on wheel
  slider.addEventListener('wheel', (e) => {
    e.preventDefault();
    const color = slider.dataset.id;
    if (color != 'A') {
      val = Math.round($(`#prog${color}`).width() * valFactor);
      if (e.deltaY > 0 && val > 0) {
        val -= 1;
      } else if (e.deltaY < 0 && val < 255) {
        val += 1;
      }
      $(`#val_${color}`).text(`00${val}`.slice(-3));
      $(`#prog${color}`).css('width', `${Math.round(val / valFactor)}px`);
    } else {
      val = Math.round(parseInt($('#progA').width() * a_ValFactor));
      if (e.deltaY > 0 && val > 0) {
        val -= 1;
      } else if (e.deltaY < 0 && val < 100) {
        val += 1;
      }
      $('#val_A').text(`${(val / 100).toFixed(2)}00`.slice(0, 4));
      $('#progA').css('width', `${Math.round(val / a_ValFactor)}px`);
      val = (val / 100).toFixed(2);
    }
    changeColor(color, val);
  })
 }

let colors = { 'R': 0, 'G': 0, 'B': 0, 'A': 0 };

const changeColor = (color, val) => {
  colors[color] = val;

  r = colors['R']; g = colors['G']; b = colors['B']; a = colors['A'];

  const xr = `0${parseInt(r).toString(16)}`.slice(-2);
  const xg = `0${parseInt(g).toString(16)}`.slice(-2);
  const xb = `0${parseInt(b).toString(16)}`.slice(-2);
  const xa = `0${parseInt(a * 255).toString(16)}`.slice(-2);

  $('.display').css('background-color', `rgba(${r}, ${g}, ${b}, ${a}`);
  $('#rgb').text(`background-color: rgba(${r}, ${g}, ${b}, ${a});`)
  $('#hex').text(`background-color: #${ xr }${ xg }${ xb }${ xa };`);
}

(() => {
  Object.entries(colors).forEach(([color, value]) => {
    color != 'A' ? value = Math.floor(Math.random() * 256) : value = 1;
    changeColor(color, value);
    if (color != 'A') {
      $(`#val_${color}`).text(`00${value}`.slice(-3));
      $(`#prog${color}`).css('width', `${value / valFactor}px`);
    } else {
      $(`#prog${color}`).css('width', `${1 / a_ValFactor * 100}px`);
    }
  }); 
})()
