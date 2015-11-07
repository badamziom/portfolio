<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="page">
            <header>
                <h1 class="hide">Logo</h1>
            </header>
            <nav>
                <h2 class="hide">Navigaction</h2>
                <?php
                $this->displayNavigation();
                ?>

            </nav>
            <section id="content">
                <h2 class="hide">Content</h2>
                <article>
                    <h2 class="hide">Kontakt</h2>
                    <?php
                    $alerts = $this->getAlerts();
                    if ($alerts != '') {
                        echo '<ul class="alerts">' . $alerts . '</ul>';
                    }
                    ?> 
                    <section id="contact">
                        <h2>Informacje o mnie</h2>
                        <p>Adam Szulist</p>
                        <p>Kościerzyna</p>
                        <p>email: aszulist@o2.pl</p>
                        <p>tel. 697 734 142</p>
                    </section>
                    <form action="" method="POST">
                        <p>Tytuł wiadomości</p>
                        <input type="text" name="tytul" placeholder="Tytuł" id="data" />
                        <p>Adres email</p>
                        <input type="email" name="email" placeholder="Email" id="data"/>
                        <p>Treść</p>
                        <textarea name="text"></textarea>
                        <br />
                        <input type="submit" name="submit" value="Wyślij" id="button" class="button" />
                    </form>
                </article>

                <footer>
                    <h2 class="hide">Footer</h2>
                    <p>Copyright © 2014 Adam Szulist</p>
                </footer>    
            </section>

        </div>
    </body>
</html>

