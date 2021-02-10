"use strict";

const upvoteForm = document.querySelectorAll(".upvote");

upvoteForm.forEach((upvote) => {
  upvote.addEventListener("submit", (event) => {
    event.preventDefault();

    const formData = new FormData(upvote);

    fetch("/app/upvotes/upvotes.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        return response.json();
      })

      .then((json) => {
        const numberOfVotes = event.target.querySelector(".amount");
        numberOfVotes.textContent = json.amount;
      });
  });
});

// MENU
const menuButtons = document.querySelectorAll(".menu-button");
const menu = document.querySelector(".drop-down");

menuButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    menu.classList.toggle("open");
  });
});
