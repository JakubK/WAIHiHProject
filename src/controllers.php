<?php
require_once 'business.php';

function gallery(&$model)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if($_POST['type'] === 'upload')
        {
            $upload_result = upload_image();
            $_SESSION['uploadInfo'] = $upload_result;
        }
        else
            markImages(true);

        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
    else
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $itemsPerPage = 5;
        $skip = ($page-1) * $itemsPerPage;

        $result = get_image_data($skip,$itemsPerPage,$maxPage);

        $model['page'] = $page;
        $model['images'] = $result ?? [];
        $model['maxPage'] = $maxPage;
        $model['author'] = isset($_SESSION['user']) ? get_user_login() : '';

        $model['uploadInfo'] = $_SESSION['uploadInfo'];
        $_SESSION['uploadInfo'] = '';

        return 'gallery';
    }
}

function search(&$model)
{
    if(isset($_GET['phrase']))
    {
        $phrase = $_GET['phrase'];
        $result = search_images($phrase);
        $model['images'] = $result;

        return 'partial/search_result';
    }
    else
    {
        return 'search';
    }
}

function marked_gallery(&$model)
{
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        markImages(false);
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
    else
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $itemsPerPage = 5;
        $skip = ($page-1) * $itemsPerPage;

        $result = get_marked_image_data($skip,$itemsPerPage,$maxPage);

        $model['page'] = $page;
        $model['images'] = $result ?? [];
        $model['maxPage'] = $maxPage;

        return "marked_gallery";
    }
}

function register_user(&$model)
{
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $register_result = processRegisterForm();
        $_SESSION['registerResult'] = $register_result;
        return 'redirect: '.$_SERVER['HTTP_REFERER'];
    }
    else 
    {
        $model['registerResult'] = $_SESSION['registerResult'];
        $_SESSION['registerResult'] = '';
        return 'register';
    }
}

function login_user(&$model)
{
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $userId = NULL;
        $loginResult = processLoginForm($userId);
        $_SESSION['user'] = $userId;
        $_SESSION['loginResult'] = $loginResult;

        return 'redirect: '.$_SERVER['HTTP_REFERER'];
    }
    else 
    {
        $model['loginResult'] = $_SESSION['loginResult'];
        $_SESSION['loginResult'] = '';
        return 'login';
    }
}

function logout()
{
    $_SESSION['user'] = NULL;
    return "login";
}

function home(&$model)
{
    return 'home';
}

function contact(&$model)
{
    return 'contact';
}