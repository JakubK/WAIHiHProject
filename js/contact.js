// localStorage.clear();

if(localStorage.getItem("formSent") == "true")
{
  $('#validationError').text("Twoja wiadomość została wysłana.");
  $('form').remove();
}

if(sessionStorage.getItem('validationError'))
  $('#validationError').text(sessionStorage.getItem('validationError'));

$( "input[type=submit]").button();
$( function() {
    $( "#dialog" ).dialog({
      autoOpen: false
    });
  } );

$('form').on('submit',function(e){
    e.preventDefault();
    let name = document.forms[0]["name"].value;
    let email = document.forms[0]["email"].value;
    let message = document.forms[0]["message"].value;

    if(name == "" || email == "" || message == "")
    {
      sessionStorage.setItem("validationError", "Wszystkie pola muszą być uzupełnione");
      $('#validationError').text(sessionStorage.getItem('validationError'));
      return;
    }

    sessionStorage.clear();
    localStorage.setItem("formSent",true);

    this.submit();

    $('#dialog').dialog("open");
    $('#validationError').text("Twoja wiadomość została wysłana.");
    $('form').remove();
});