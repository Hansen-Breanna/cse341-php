// Toggle visibility of week assignments
// https://api.jquery.com/slidetoggle/
$(document).ready(function(){
    $("#week-02").hide();

    $("#vis-wk-02").click(function(){
      $("#week-02").toggle();
    });
  });