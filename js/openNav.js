function openNav() {
  var nav = document.getElementById("navig");
  if (nav.className === "navig") {
    nav.className += " responsive";
  } else {
    nav.className = "navig";
  }
}
