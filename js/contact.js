$('#validationError').text(sessionStorage.getItem('validationError'));

$( "input[type=submit]").button();

$( function() {
    $( "#dialog" ).dialog({
      autoOpen: false
    });
  } );

$('form').on('submit',function(){

    
    let name = document.forms[0]["name"].value;
    let email = document.forms[0]["email"].value;
    let message = document.forms[0]["message"].value;

    if(name == "" || email == "" || message == "")
    {
      sessionStorage.setItem("validationError", "You need to fill every field");
      $('#validationError').text(sessionStorage.getItem('validationError'));
      return;
    }

    sessionStorage.clear();
    $('#validationError').text(sessionStorage.getItem('validationError'));
    $('#dialog').dialog("open");
})

