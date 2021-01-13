// Toggle visibility of week assignments
// https://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_lib_google
// https://api.jquery.com/slidetoggle/
$(document).ready(function(){
    $("#visibility").click(function(){
      $("#week-02").toggle("slow");
    });
  });