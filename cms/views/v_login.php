<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-1.11.0.min.js"></script>
        <script src="../js/script.js"></script>
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
                        <h2 class="hide">Logowaie</h2>
                        <?php
                            $alerts = $this->getAlerts();
                            if($alerts != ''){
                               echo '<ul class="alerts">' . $alerts . '</ul>';
                            }
                        ?> 
                        <form action="" method="POST">
                            <p>Login</p>
                            <input type="text" name="username" placeholder="Login" id="data" />
                            <p>Hasło</p>
                            <input type="password" name="password" placeholder="Hasło" id="data"/>
                            <br />
                            <input type="submit" name="submit" value="Wyślij" class="button" />
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
