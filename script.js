let isOpen = true;
let sideNav = document.getElementById("side-nav");

document.getElementById("nav-button").addEventListener("click", () => {
  if (!isOpen) {
    document.querySelector('svg:nth-child(1) path').setAttribute('d', "M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z");
    sideNav.style.width = "30rem";
  } else {
    document.querySelector('svg:nth-child(1) path').setAttribute('d', "M3 18v-2h18v2H3Zm0-5v-2h18v2H3Zm0-5V6h18v2H3Z");
    sideNav.style.width = "0px";
  }
  isOpen = !isOpen;
})

document.querySelectorAll("#auth-link").forEach(link => {
  link.addEventListener('click', (event) => {
    let isRegister = event.target.innerText == "Register";
    document.querySelector(".login").style.display = isRegister ? "none" : "flex";
    document.querySelector(".register").style.display = isRegister ? "flex" : "none";
  });
})

let modalContainer = document.querySelector(".modal-container");
let createModal = document.querySelector(".create");
let editModal = document.querySelector(".edit");

document.getElementById("create-post").addEventListener("click", () => {
  modalContainer.style.display = "flex";
  createModal.style.display = "block";

  document.getElementById("close-create").addEventListener("click", () => {
    modalContainer.style.display = "none";
    createModal.style.display = "none";
  })
})

document.querySelectorAll("#edit-post").forEach(button => {
  button.addEventListener("click", () => {
    modalContainer.style.display = "flex";
    editModal.style.display = "block";
    document.getElementById("title").value = button.getAttribute("title")
    document.getElementById("body").value = button.getAttribute("body")
    document.getElementById("id").value = button.getAttribute("postid")
  
    document.getElementById("close-edit").addEventListener("click", () => {
      modalContainer.style.display = "none";
      editModal.style.display = "none";
    })
  })
})

document.getElementById('logout-button').addEventListener('click', () => {
  console.log("Logged Out");
  window.location.href = 'logout.php'; // Replace with the correct path to your logout script
});