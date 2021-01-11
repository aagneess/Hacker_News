function getContent() {
  document.getElementById("textarea").value = document.getElementById(
    "post-title",
    "post-link",
    "post-content"
  ).innerHTML;
}
