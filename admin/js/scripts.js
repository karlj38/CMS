$(function () {
  if ($("#editor").length) {
    ClassicEditor.create(document.querySelector("#editor"))
      .then((editor) => {
        console.log(editor);
      })
      .catch((error) => {
        console.error(error);
      });
  }

  if ($("#selectAllPosts").length) {
    $("#selectAllPosts").click(function (event) {
      $(".checkbox").each(function () {
        this.checked = !this.checked;
      });
    });
  }
});
