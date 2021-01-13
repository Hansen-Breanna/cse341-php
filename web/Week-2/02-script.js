function clickedAlert() {
    alert("Clicked!");
}

// Change div #1 background color with javascript
// function changeBackground() {
//     var hexColor = document.getElementById('hexColor').value;
//     var boxOne = document.getElementById('box-1');
//     boxOne.style.backgroundColor = hexColor;
// }

// Change div #1 background color with jquery
$(document).ready(function(){
    $("#changeColor").click(function(){
        $("#box-1").css("background-color", $("#hexColor").val());
    });
  });

// Toggle visibility of div #3
// https://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_lib_google
$(document).ready(function(){
    $("#visibility").click(function(){
      $("#box-3").hide();
    });
  });