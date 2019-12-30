<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moje Hobby</title>
        <link rel="stylesheet" href="static/css/jquery-ui.min.css"/>
        <link rel="stylesheet" href="static/css/jquery-ui.theme.min.css"/>
        <link rel="stylesheet" href="static/css/reset.css"/>
        <link rel="stylesheet" href="static/css/common.css"/>
        <link rel="stylesheet" href="static/css/contact.css"/>
    </head>
    <body>
        <?php include 'partial/navbar.php' ?>        
        <header>
            <h1>Moje Hobby - Programowanie</h1>
        </header>
        <p>
            Chcesz się ze mną skontaktować? Użyj poniższego formularza.<br/>
            Lub napisz maila <a href="mailto:s180125@student.pg.edu.pl">bezpośrednio do mnie</a>
        </p>
        <iframe style="display: none" width="0" height="0" name="dummyframe" id="dummyframe"></iframe>
        <p id="validationError"></p >
        <form target="dummyframe" method="POST" action="http://localhost/index.php" >
            <input placeholder="Twoje imie i nazwisko" name="name" type="text"/><br/>
            <input placeholder="Twój adres E-mail" name="email" type="text"/><br/>
            <input type="radio" value="female" name="gender"/>
            <label for="female">Kobieta</label>
            <input type="radio" value="male" name="gender"/>
            <label for="male">Mężczyzna</label>
            <textarea name="message" placeholder="Twoja wiadomość"></textarea><br/>
            <select name="category">
                <option>Propozycja współpracy</option>
                <option>Pytanie o projekt</option>
                <option>Inne</option>
            </select>
            <label for="category">Kategoria formularza</label><br/>
            <input type="checkbox" name="newsletter"/>
            <label for="newsletter">Czy chcesz zapisać się na newsletter z informacjami o moich projektach?</label>
            <input type="submit" value="Wyślij formularz"/>
            <input type="reset" value="Zresetuj formularz"/>
        </form>
        <div id="dialog" title="Formularz został wysłany">
            <p>Wszystkie dane zostały podane. Formularz został wysłany</p>
        </div>
        <?php include 'partial/footer.php' ?>
        <script src="static/js/jquery-3.4.1.min.js"></script>
        <script src="static/js/jquery-ui.min.js"></script>
        <script src="static/js/contact.js"></script>
    </body>
</html>