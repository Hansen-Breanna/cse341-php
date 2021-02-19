// Toggle visibility of week assignments
// https://api.jquery.com/slidetoggle/
$(document).ready(function(){

    // Nav toggle
      $(".navbar-toggler").click(function(){
        $("#link-nav").toggle();
      });
      
  });


  function confirm() {
    $pass = document.getElementById("password").value;
    $confirm = document.getElementById("confirm_password").value;
    if ($pass == $confirm) {
        document.getElementById("confirmed").innerHTML = "Password inputs match.";
    } else {
        document.getElementById("confirmed").innerHTML = "Passwords do not match.";
    }
}