<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moje Hobby</title>
        <link rel="stylesheet" href="static/css/reset.css"/>
        <link rel="stylesheet" href="static/css/common.css"/>
        <link rel="stylesheet" href="static/css/index.css"/>
    </head>
    <body>
        <?php include 'partial/navbar.php' ?>
        <header>
            <h1>Moje Hobby - Programowanie</h1>
        </header>
        <section id="beginnings">
            <h2>Początki</h2>
            <p id="story">Moja przygoda z programowaniem zaczęła się już w gimnazjum gdy przez przypadek natrafiłem na książkę z nią związaną<br/>
                Zacząłem od Javy, ale chciałem poznawać inne języki aż nie znajdę takiego który spodoba mi się na tyle by z nim zostać.
                Ostatecznie po paru próbach wybór padł na C#. Stworzyłem wiele projektów opartych o technologie związane z tym językiem. Były to zarówno aplikacje webowe jak i gry oraz aplikacje mobilne.
                Dopiero niedawno zacząłem je dokumentować w serwisie GitHub.
            </p>
        </section>
        <section id="projects">
            <h2>Wybrane projekty</h2>
            <p>Podczas mojej samodzielnej nauki udało mi się stworzyć wiele aplikacji. Postanowiłem opisać niektóre z nich</p>
            <p>Więcej zdjęć znajdziesz w <a href="gallery.html"> galerii.</a></p>
            <div class="projects_container">
                <div class="project">
                    <h4>LinCon</h4>
                    <img alt="project-image" src="static/img/Lincon_1.png"/>
                    <p>Aplikacja do zarządzania linkami</p>
                </div>
                <div class="project">
                    <h4>Liga sportowa</h4>
                    <img alt="project-image" src="static/img/Lincon_2.png"/>
                    <p>Aplikacja Ligii sportowej</p>
                </div>
                <div class="project">
                    <h4>2048</h4>
                    <img alt="project-image" src="static/img/2048_1.jpg"/>
                    <p>Gra logiczna 2048</p>
                </div>
            </div>
        </section>
        <section id="skills">
            <h2>Umiejętności</h2>
            <p>Używałem wielu języków i technologii z nimi powiązanych gdy już udało mi się <a href="#story">wystartować</a>, poniżej zestawiłem te w których najbardziej planuję się rozwijać</p>
            <table>
                <thead>
                    <tr>
                        <th>Język</th>
                        <th>Powiązane technologie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>C#</td>
                        <td>Unity3D, WPF, WinForms, ASP.NET, ASP.NET Core, GraphQL, Xamarin.Forms</td>
                    </tr>
                    <tr>
                        <td>JavaScript</td>
                        <td>Vue.js, Node.js, React.js</td>
                    </tr>
                    <tr>
                        <td>HTML & CSS</td>
                        <td>Bootstrap, SCSS, Bulma.css</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section id="contact">
            <h2>Kontakt</h2>
            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-envelope">
                <path transform="rotate(10 10 10)" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z" class="">
                    <animate attributeName="fill" values="red;blue;red" dur="10s" repeatCount="indefinite" />
                    <animateTransform attributeName="transform"
                        attributeType="XML"
                        type="rotate"
                        from="0 60 70"
                        to="360 60 70"
                        dur="1s"
                        repeatCount="indefinite"/>
                </path>
            </svg>
            <p>Możesz się ze mną skontaktować poprzez formularz kontaktowy który znajdziesz <a href="contact.html">tutaj</a></p>
        </section>
        <?php include 'partial/footer.php' ?>
        <script src="static/js/jquery-3.4.1.min.js"></script>
        <script src="static/js/index.js"></script>
    </body>
</html>