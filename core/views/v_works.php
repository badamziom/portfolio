<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <script src="js/script.js"></script>
        <link href="css/lightbox.css" rel="stylesheet" />
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
            <section  id="content">
                <h2 class="hide">Content</h2>
                <article>
                    <?php
                    $alerts = $this->getAlerts();
                    if ($alerts != '') {
                        echo '<ul class="alerts">' . $alerts . '</ul>';
                    }
                    ?> 
                    <h2 class="hide">Portfolio</h2>
                    <?php
                    $this->displayWorks();
                    ?>
                </article>

                <footer>
                    <h2 class="hide">Footer</h2>
                    <p>Copyright © 2014 Adam Szulist</p>
                </footer>    
            </section>

        </div>
    </body>
</html>
