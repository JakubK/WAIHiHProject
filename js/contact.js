$( "input[type=submit]").button();

$( function() {
    $( "#dialog" ).dialog({
      autoOpen: false
    });
  } );

$('form').on('submit',function(){
    $('#dialog').dialog("open");
})