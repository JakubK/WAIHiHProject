<?php

use MongoDB\BSON\ObjectID;

function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function get_products()
{
    $db = get_db();
    return $db->products->find()->toArray();
}

function get_products_by_category($cat)
{
    $db = get_db();
    $products = $db->products->find(['cat' => $cat]);
    return $products;
}

function get_product($id)
{
    $db = get_db();
    return $db->products->findOne(['_id' => new ObjectID($id)]);
}

function save_product($id, $product)
{
    $db = get_db();

    if ($id == null) {
        $db->products->insertOne($product);
    } else {
        $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
    }
    return true;
}

function delete_product($id)
{
    $db = get_db();
    $db->products->deleteOne(['_id' => new ObjectID($id)]);
}

function upload_image()
{
    include_once "validate.php";

    $validate_result = validate_gallery_input();
    if($validate_result !== NULL)
        return $validate_result;
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_name = $_FILES['file']['tmp_name'];
    $mime_type = finfo_file($finfo,$file_name);

    if(($mime_type === 'image/jpeg' || $mime_type === 'image/png') && $_FILES['file']['type'] == $mime_type) 
    {
        include 'paths.php';

        $upload_dir = $paths['images'];
        $file = $_FILES['file'];
        $temp = explode(".", $_FILES["file"]["name"]);
        $file_name = round(microtime(true)) . '.' . end($temp);
        $target = $upload_dir . $file_name;
        $tmp_path = $file['tmp_name'];

        if(move_uploaded_file($tmp_path, $target))
        {
            require 'image_operations.php';
            //thumbnail
            generate_thumbnail($target,$mime_type, $paths['thumbnails'].$file_name);            
            // //watermark
            generate_watermark($target,$mime_type, $paths['watermarks'].$file_name);
            return 'Udało się przesłać plik';
        }
    }
    else
        return "Niepoprawny format pliku. Wspierane formaty to PNG oraz JPEG";
}

function fetch_images_data($page, $skip, $itemsPerPage)
{
    include 'paths.php';

    $pathThumbnails = $paths['thumbnails'];
    $allThumbnails = glob($pathThumbnails.'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE);
    $imagesCount = count($allThumbnails);
    $maxPage = $imagesCount % $itemsPerPage === 0 ? intdiv($imagesCount,$itemsPerPage) : intdiv($imagesCount,$itemsPerPage) + 1;

    $pathWatermarked = $paths['watermarks'];
    $allWatermarked = glob($pathWatermarked.'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE);

    $i = 0;
    $allImages = array_map(NULL,$allWatermarked,$allThumbnails);
    usort($allImages, function($a,$b)
    {
        return filemtime($a[0]) - filemtime($b[0]);
    });
    
    array_splice($allImages,0,$skip);

    foreach($allImages as $image)
    {
        $images[] = (object)[
            "watermark" => $image[0],
            "thumbnail" => $image[1]
        ];
        $i++;
        if($i === $itemsPerPage)
            break;
    }

    return (object)[
        "maxPage" => $maxPage,
        "images" => $images
    ];
}