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

            //Insert data to DB
            save_image_data($paths['thumbnails'].$file_name,
                $paths['watermarks'].$file_name,
                $_POST['author'],
                $_POST['title']);

            return 'Udało się przesłać plik';
        }
    }
    else
        return "Niepoprawny format pliku. Wspierane formaty to PNG oraz JPEG";
}

function get_image_data($skip,$take,&$maxPage)
{
    $opts = [
        'skip' => $skip,
        'limit' => $take
    ];

    $db = get_db();
    $result = $db->images->find()->toArray();
    $count = count($result);
    $maxPage = $count % $take === 0 ? intdiv($count,$take) : intdiv($count,$take) + 1;
    $result = $db->images->find([],$opts)->toArray();

    return $result;
}

function save_image_data($thumbnailPath,$watermarkPath, $author,$title)
{
    $db = get_db();
    $db->images->insertOne((object)[
        "author" => $author,
        "title" => $title,
        "thumbnail" => $thumbnailPath,
        "watermark" => $watermarkPath
    ]);
}

function processRegisterForm()
{
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    if(empty($login) || empty($email) || empty($password) || empty($passwordRepeat)) //not all fields were filled
        return 'Nie wszystkie pola zostały wypełnione';

    //check if email exists in the Database
    $db = get_db();
    $emails = $db->users->find([
        "email" => $email
    ])->toArray();

    $logins = $db->users->find([
        "login" => $login
    ])->toArray();

    if(count($emails) !== 0) //email taken
        return 'Podany adres email jest już zajęty';

    if(count($logins) !== 0) //login taken
        return 'Podany login jest już zajęty';

    if($password === $passwordRepeat) //create user
    {
        $db->users->insertOne((object)[
            "email" => $email,
            "login" => $login,
            "password" => hash("sha256",$password)
        ]);

        return "Udało się stworzyć użytkownika";
    } 
}

function processLoginForm(&$userId)
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    if(empty($login) || empty($password)) //not all fields were filled
        return 'Nie wszystkie pola zostały wypełnione';

    $db = get_db();
    $user = $db->users->find([
        "login" => $login,
        "password" => hash("sha256", $password)
    ])->toArray();

    if(count($user) !== 0)
    {
        $userId = $user[0]->_id;
        return "Zalogowano pomyślnie"; 
    }
}

?>