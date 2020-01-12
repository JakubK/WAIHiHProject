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
        <?php if(!isset($_SESSION['user']) || $_SESSION['user'] === NULL): ?>
        <div class="auth_form">
            <?=$loginResult ?? ''?>
            <p>Logowanie</p>
            <form method="POST">
                <label>Login</label>
                <input name="login" type="text"/>
                <label>Hasło</label>
                <input name="password" type="password"/><br/>
                <input type="submit"/>
            </form>
        </div>
        <?php else:?>
            <div class="auth_form">
                <p>Zalogowano pomyślnie</p>
            </div>
        <?php endif?>
        <?php include 'partial/footer.php' ?>
    </body>
</html>