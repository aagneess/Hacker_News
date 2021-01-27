"use strict";

const upvotes = document.querySelectorAll("section.upvotes");

upvotes.forEach((button) => {
  const upvoteButton = button.querySelector(".upvote");
  const id = upvoteButton.dataset.id;
  const numberOfVotes = button.querySelector(".amount");

  console.log(upvoteButton);

  upvoteButton.addEventListener("click", () => {
    const form = new FormData();
    form.append("postId", id);
    fetch("/app/upvotes/upvotes.php", {
      method: "post",
      body: form,
    })
      .then((response) => response.json())
      .then((amount) => {
        numberOfVotes.textContent = amount;
      });
  });
});
