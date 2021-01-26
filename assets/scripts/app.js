// function getContent() {
//   document.getElementById("textarea").value = document.getElementById(
//     "post-title",
//     "post-link",
//     "post-content"
//   ).innerHTML;
// }

const menuButtons = document.querySelectorAll(".menu-button");
const menu = document.querySelector(".drop-down");

menuButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    menu.classList.toggle("open");
  });
});
