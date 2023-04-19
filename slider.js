function shrink(cursor) {
  let curx = cursor;
  curx += 'x';
  let thisone = document.getElementById(curx),
  letras = document.getElementsByClassName("letras");
  for (count = 0; count < letras.length; count++) {
    letras[count].classList.add('inactiveLetra');
  }
  thisone.classList.remove('inactiveLetra');
}
function reset() {
  let letras = document.getElementsByClassName("letras");
  for (count = 0; count < letras.length; count++) {
    letras[count].classList.remove('inactiveLetra');
    letras[count].classList.remove('activeLetra');
  }
}
const btnPersonaDer = document.getElementById('personaLeft'),
btnPersonaIzq = document.getElementById('personaRight'),
persDiv = document.getElementById('containerP');
function scrollToElement(vars,fx){
  let tarjeta = document.getElementById(fx),
  inner = tarjeta.children[0];
  inner.classList.add("verTarjeta");
  setTimeout(function(){
    inner.classList.remove("verTarjeta");
  }, 1500);
  let win = window.innerWidth,
  xoff = win/2;
  persDiv.scrollTo({
    left: vars-xoff+130,
    behavior: 'smooth',
  });
}
btnPersonaDer.addEventListener("click", function(event) {
  persDiv.scrollLeft -= 150;
  event.preventDefault();
});
btnPersonaIzq.addEventListener("click", function(event) {
  persDiv.scrollLeft += 150;
  event.preventDefault();
});
