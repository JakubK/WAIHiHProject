<?php foreach ($images as $image): ?>
    <div class="item">
        <a href="<?=$image->watermark?>">
            <img alt="gallery-image" src="<?=$image->thumbnail?>"/>
        </a>
    </div>
<?php endforeach?>