// Toggle visibility of week assignments
// https://api.jquery.com/slidetoggle/
$(document).ready(function(){

    // Nav toggle
      $(".navbar-toggler").click(function(){
        $("#link-nav").toggle();
      });

          // Nav toggle
          $("#enableSelectAuthor").click(function(){
            $("#authorList").toggle();
          });

              // Nav toggle
      $("#enableAddAuthor").click(function(){
        $("#first_name").toggle();
      });
  });

