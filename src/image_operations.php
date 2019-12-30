<?php

function generate_thumbnail($source,$mime_type, $upload_dir)
{
    if($mime_type === 'image/png')
        $source_image = imagecreatefrompng($source);
    else
        $source_image = imagecreatefromjpeg($source);
    
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    $desired_height = 125;
    $desired_width = 200;
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    
    imagealphablending($virtual_image,false);
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    imagesavealpha($virtual_image,true);

    if($mime_type === 'image/png')
        imagepng($virtual_image, $upload_dir);
    else
        imagejpeg($virtual_image, $upload_dir);

    imagedestroy($virtual_image);
    imagedestroy($source_image);
}

function generate_watermark($source,$mime_type, $upload_dir)
{
  if($mime_type === 'image/png')
    $source_image = imagecreatefrompng($source);
  else
    $source_image = imagecreatefromjpeg($source);

  $white = imagecolorallocatealpha($source_image,255,255,255,75);
  $font = "../../arial.ttf";
  imagettftext($source_image, 20, -45, 10, 20, $white, $font, $_POST['watermark']);
  imagesavealpha($source_image,true);

  if($mime_type === 'image/png')
    imagepng($source_image, $upload_dir);
  else
    imagejpeg($source_image, $upload_dir);

  imagedestroy($source_image);
}


?>