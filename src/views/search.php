<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moje Hobby</title>
        <link rel="stylesheet" href="static/css/reset.css"/>
        <link rel="stylesheet" href="static/css/common.css"/>
        <link rel="stylesheet" href="static/css/forms.css"/>
    </head>
    <body>
        <?php include 'partial/navbar.php' ?>
        <input id="ajax" class="ajax-searchbar" placeholder="Zacznij wpisywać tytuł poszukiwanego zdjęcia" type="text"/>
        <div id="gallery" class="gallery">
        </div>
        <?php include 'partial/footer.php' ?>
        <script>
          const searchbar = document.getElementById('ajax');
          const gallery = document.getElementById('gallery');
          searchbar.addEventListener('keyup',function()
          {
            if(searchbar.value.length > 0)
            {
              fetch('?phrase=' + searchbar.value).then(result => result.text()).then(data => 
              {
                gallery.innerHTML = data;
              });
            }
          });
        </script>
    </body>
</html>