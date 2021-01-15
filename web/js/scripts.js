// Toggle visibility of week assignments
// https://api.jquery.com/slidetoggle/
$(document).ready(function(){
    // initially hide all weeks
    $("#week-02").hide();
    $("#week-03").hide();
    $("#week-04").hide();
    $("#week-05").hide();
    $("#week-06").hide();
    $("#week-07").hide();
    $("#week-08").hide();
    $("#week-09").hide();
    $("#week-10").hide();
    $("#week-11").hide();
    $("#week-12").hide();
    $("#week-13").hide();
    $("#week-14").hide();

    // Toggle weeks
    $("#vis-wk-02").click(function(){
      $("#week-02").toggle();
    });
    $("#vis-wk-03").click(function(){
        $("#week-03").toggle();
      });
      $("#vis-wk-04").click(function(){
        $("#week-04").toggle();
      });
      $("#vis-wk-05").click(function(){
        $("#week-05").toggle();
      });
      $("#vis-wk-06").click(function(){
        $("#week-06").toggle();
      });
      $("#vis-wk-07").click(function(){
        $("#week-07").toggle();
      });
      $("#vis-wk-08").click(function(){
        $("#week-08").toggle();
      });
      $("#vis-wk-09").click(function(){
        $("#week-09").toggle();
      });
      $("#vis-wk-10").click(function(){
        $("#week-10").toggle();
      });
      $("#vis-wk-11").click(function(){
        $("#week-11").toggle();
      });
      $("#vis-wk-12").click(function(){
        $("#week-12").toggle();
      });
      $("#vis-wk-13").click(function(){
        $("#week-13").toggle();
      });
      $("#vis-wk-14").click(function(){
        $("#week-14").toggle();
      });

      // Nav toggle
      $(".navbar-toggler").click(function(){
        $("#link-nav").toggle();
      });
  });

  function navToggle() {
    document.getElementById('nav-border').style.borderTop = '1px solid #f7f7f7';
  }