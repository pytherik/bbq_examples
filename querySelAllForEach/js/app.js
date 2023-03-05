const head1 = document.querySelector("#head1");
const head2 = document.querySelector("#head2");
const head3 = document.querySelector("#head3");
const allButtons = document.querySelectorAll("button");
console.log(allButtons);
console.log(typeof (allButtons));
// allButtons.forEach(function (button) {
//   button.addEventListener("click", () => {
//     x = button.dataset.id;
//     head2.innerHTML =  x;
//     $(`#head${x}`).text('hallo');
    
//   });
// });

// const header = (h) => {
//   if (h == "head1"){
//       head1.innerHTML = "hallo";
//   } else if (h =="head2") {
//       head2.innerHTML = "welt";
//   } else {
//       head3.innerHTML = "go home";
//   }
// }
