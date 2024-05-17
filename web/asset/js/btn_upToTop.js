var topButton = document.getElementById("topButton");
window.addEventListener("scroll", () => {
  if (window.scrollY > window.innerHeight / 2) {
    topButton.style.display = "block";
  } else {
    topButton.style.display = "none";
  }
})

const check_totop = () => {
  if (window.scrollY < window.innerHeight / 2) {
    topButton.style.display = "none";
  }
}

topButton.addEventListener("click", () => {
  window.scrollTo(0, 0);
})

check_totop();