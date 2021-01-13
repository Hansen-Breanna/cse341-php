// Toggle visibility of week assignments
// https://api.jquery.com/slidetoggle/
$(document).ready(function(){
    $("#vis-wk-02").hide();

    $("#vis-wk-02").click(function(){
      $("#week-02").removeClass('d-none');
    });
  });