
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moje Hobby</title>
        <link rel="stylesheet" href="static/css/reset.css"/>
        <link rel="stylesheet" href="static/css/common.css"/>
        <link rel="stylesheet" href="static/css/gallery.css"/>
    </head>
    <body>
        <?php include 'partial/navbar.php' ?>
        <header>
            <h1>Zapamiętane zdjęcia</h1>
        </header>
        <p>
            Poniżej znajdują się zapamiętane zdjęcia
        </p>
        <?php if($images): ?>
            <form method="POST">
                <input type="hidden" name="type" value="markImages"/>
                <div class="gallery">
                    <?php foreach ($images as $image): ?>
                        <div class="item-description">
                            <input name="check[]" type="checkbox" 
                            value="<?=$image->_id?>"/>
                            <?=$image->author?>
                            <?=$image->title?>
                        </div>
                        <div class="item">
                            <a href="<?=$image->watermark?>">
                                <img alt="gallery-image" src="<?=$image->thumbnail?>"/>
                            </a>
                        </div>
                    <?php endforeach?>
                </div>
                <input type="submit" value="Usuń zaznaczone z wybranych"/>
            </form>
        <?php endif?>
        <div class="gallery-nav">
            <?php if($maxPage > 0): ?>
                <p>
                    <?=$page?>/<?=$maxPage?><br/>
                    <a
                    <?php if($page > 1): ?> 
                        href="?page=<?=$page-1?>"
                    <?php endif?>
                >Previous</a>     
                <a
                    <?php if($page < $maxPage): ?> 
                        href="?page=<?=$page+1?>"
                    <?php endif?>
                >Next</a>
                </p>
            <?php endif?>
            <?php if($maxPage <= 0):?>
                <p>Brak zdjęć w galerii</p>
            <?php endif?>
        </div>
        <div id="modal">
            <span class="close-btn">&times;</span>
            <img src="" id="modal-img"/>
        </div>
        <?php include 'partial/footer.php' ?>
        <script src="static/js/gallery.js"></script>
    </body>
</html>