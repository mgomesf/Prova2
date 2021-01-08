$(document).ready(function () {
  var children = $("#body-table")[0].children;

  for (var i = 0; i < children.length; i++) {
    const child = children[i].getElementsByClassName("date-mask")[0];

    var date = child.innerText.split("-");
    date = `${date[2]}/${date[1]}/${date[0]}`;

    $(`#${child.id}`)[0].innerText = date;
  }
});
