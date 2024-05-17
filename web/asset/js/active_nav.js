// var click = document.getElementById("nav-item-end").addEventListener("click", displayActive);
let nav_page = document.getElementById("nav_page").value;

displayActiveNav(nav_page);

function displayActiveNav(page) {

  let number_for = 15;

  for (let i = 0; i < number_for; i++) {

    if (page == i) {
      let active = document.querySelector("#nav-link" + i);
      active.classList.add("active");
      active.style.color = "#000";
    }
  }

};


