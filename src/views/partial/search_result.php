<?php foreach ($images as $image): ?>
    <div class="item">
        Tytuł: <?=$image->title?>
        <a href="<?=$image->watermark?>">
            <img alt="gallery-image" src="<?=$image->thumbnail?>"/>
        </a>
    </div>
<?php endforeach?>