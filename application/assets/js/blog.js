document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-more").forEach((element) => {
      element.addEventListener("click", function () {
        const hiddenComments = this.previousElementSibling;
        hiddenComments.classList.toggle("hidden-comment");
        this.textContent = hiddenComments.classList.contains(
          "hidden-comment"
        )
          ? "Ver más comentarios..."
          : "Ver menos comentarios...";
      });
    });
  });