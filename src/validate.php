<?php

function validate_gallery_input()
{
  if(empty($_FILES['file']['name']))
  {
      return "Brak pliku";
  }
  else if(empty(($_POST['watermark'])))
  {
      return "Tekst dla znaku wodnego jest wymagany";
  }
  else if($_FILES['file']['size'] > 1000000)
  {
      return "Plik za duży. Maksymalny rozmiar to 1MB";
  }

  return NULL;
}

?>