$(document).ready(function () {

  tinyMCE.init({
    selector:'textarea',
    mode: "exact",
    theme_advanced_toolbar_location: "top",
    theme_advanced_buttons1: "bold,italic,underline,strikethrough,separator,"
    + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
    + "bullist,numlist,outdent,indent",
    theme_advanced_buttons2: "link,unlink,anchor,image,separator,"
    + "undo,redo,cleanup,code,separator,sub,sup,charmap",
    theme_advanced_buttons3: "",
    setup:function(ed) {
      ed.on('change', function(e) {
        $("#"+ed.id).text(ed.getContent());
      });
    }
  });

})