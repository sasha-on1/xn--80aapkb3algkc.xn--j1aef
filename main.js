$(document).ready(function () {
  $('[data-toggle="popover"]').popover();
});
$('.popover-dismiss').popover({
  trigger: 'focus'
})

function my_f() {
  var object = document.getElementsByClassName(".hidden");
  object.style.display == 'none' ? object.style.display = 'flex' : object.style.display = 'flex';
}

function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}