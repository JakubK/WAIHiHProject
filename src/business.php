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

function upload_image($file,$imageData)
{
    include_once "validate.php";

    $validate_result = validate_gallery_input();
    if($validate_result !== NULL)
        return $validate_result;
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    $file_name = $file['tmp_name'];

    $mime_type = finfo_file($finfo,$file_name);

    if(($mime_type === 'image/jpeg' || $mime_type === 'image/png') && $file['type'] == $mime_type) 
    {
        include 'paths.php';

        $upload_dir = $paths['images'];
        $temp = explode(".", $file["name"]);
        $file_name = round(microtime(true)) . '.' . end($temp);
        $target = $upload_dir . $file_name;
        $tmp_path = $file['tmp_name'];
        
        if(move_uploaded_file($tmp_path, $target))
        {
            require 'image_operations.php';
            //thumbnail
            generate_thumbnail($target,$mime_type, $paths['thumbnails'].$file_name);            
            // //watermark
            generate_watermark($target,$mime_type, $paths['watermarks'].$file_name,$imageData->watermark);

            //Insert data to DB
            save_image_data($paths['thumbnails'].$file_name,
                $paths['watermarks'].$file_name,
                $imageData->author,
                $imageData->title,
                $imageData->access ?? NULL);

            return 'Udało się przesłać plik';
        }
    }
    else
        return "Niepoprawny format pliku. Wspierane formaty to PNG oraz JPEG";
}

function save_image_data($thumbnailPath,$watermarkPath, $author,$title,$access)
{
    $db = get_db();
    $imageToInsert = [
        "author" => $author,
        "title" => $title,
        "thumbnail" => $thumbnailPath,
        "watermark" => $watermarkPath
    ];
    if(isset($access) && $access === 'private')
        $imageToInsert["private"] = true;

    $db->images->insertOne($imageToInsert);
}

function get_image_data($skip,$take,&$maxPage)
{
    $opts = [
        'skip' => $skip,
        'limit' => $take
    ];

    $db = get_db();
    $count = $db->images->count();
    $maxPage = $count % $take === 0 ? intdiv($count,$take) : intdiv($count,$take) + 1;

    $query = ['$or' => [
        ['author' => get_user_login()],
        ['private' => NULL]
    ]];

    $result = $db->images->find($query,$opts)->toArray();

    return $result;
}

function search_images($phrase)
{
    $db = get_db();
    $query = ['$and' => [
        [
            'private' => NULL
        ],
        [
            'title' => ['$regex' => ".*".$phrase.".*"]
        ]
    ]];

    $result = $db->images->find($query)->toArray();
    return $result;
}

function get_marked_image_data($checks, $skip,$take,&$maxPage)
{
    $opts = [
        'skip' => $skip,
        'limit' => $take
    ];

    $db = get_db();

    for($i = 0;$i < count($checks);$i++)
        $checks[$i] = new ObjectId($checks[$i]);

    $query = ['_id' => ['$in' => $checks]];
    $count = $db->images->count($query);

    $maxPage = $count % $take === 0 ? intdiv($count,$take) : intdiv($count,$take) + 1;
    $result = $db->images->find($query,$opts)->toArray();

    return $result;
}

function processRegisterForm($login,$email,$password,$passwordRepeat)
{
    if(empty($login) || empty($email) || empty($password) || empty($passwordRepeat)) //not all fields were filled
        return 'Nie wszystkie pola zostały wypełnione';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        return 'Podany adres email nie jest poprawny';
    
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
    else 
    {
        return "Podane hasła nie są sobie równe";
    }
}

function processLoginForm($login,$password, &$userId)
{
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
    else 
    {
        return "Niepoprawne dane logowania";
    }
}

function markImages($checks,$markValue)
{
    if(!empty($checks))
    {
        if($markValue === true)
        {
            //add item to array if it does not exist here
            if(isset($_SESSION['check']))
            {
                foreach($checks as $check)
                {
                    if(!in_array($check,$_SESSION['check']))
                    {
                        array_push($_SESSION['check'],$check);
                    }
                }
            }
            else
            {
                $_SESSION['check'] = $checks;
            }
        }
        else //remove selected items
        {
            $_SESSION['check'] = array_diff($_SESSION['check'],$checks);
        }
    }
}

function get_user_login()
{
    $db = get_db();
    
    if(!isset($_SESSION['user']))
        return NULL;

    $user = $db->users->find([
        "_id" => $_SESSION['user']
    ])->toArray();

    return $user[0]['login'];
}
?>