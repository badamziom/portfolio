<?php

class Template {

    private $data;
    private $alertType;
    private $AdamCms;

    function __construct() {
        global $AdamCms;
        $this->AdamCms = & $AdamCms;
    }

    function load($url) {
        include($url);
    }

    function redirect($url) {
        header("Location: $url");
    }

    function setData($name, $value) {
        $this->data[$name] = $value;
    }

    function getData($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return '';
        }
    }

    function setAlertTypes($types) {
        $this->setAlertTypes = $types;
    }

    function setAlert($value, $type = NULL) {
        if ($type == '') {
            $type = $this->alertType[0];
        }
        $_SESSION[$type][] = $value;
    }

    function getAlerts() {
        $data = '';
        foreach ($this->setAlertTypes as $alert) {
            if (isset($_SESSION[$alert])) {
                foreach ($_SESSION[$alert] as $value) {
                    $data .= '<li class="alert ' . $alert . '">' . $value . '</li>';
                }
                unset($_SESSION[$alert]);
            }
        }
        return $data;
    }

    function displayDescription() {



        if ($stmt = $this->AdamCms->Database->query("SELECT * FROM description ORDER BY id")) {
            $stmt->fetch_array();
            foreach ($stmt as $value) {
                if ($value['type'] == "paragraph") {
                    echo '<p class="informaction">' . $value['content'] . '</p>';
                } else {
                    $content = explode("-", $value['content']);
                    echo '<ul>';
                    foreach ($content as $record) {
                        echo '<li>' . $record . '</li>';
                    }
                    echo '</ul>';
                }
            }
        } else {
            die('Bląd w zapytaniu do bazy');
        }
    }

    function displayWorks() {

        if ($stmt = $this->AdamCms->Database->query("SELECT * FROM works ORDER BY id")) {
            $stmt->fetch_array();
            foreach ($stmt as $value) {
                echo '<div class="my_work">';
                echo '<a href="' . IMAGE_PATH . $value['image'] . '" data-lightbox="Work1" data-title="' . $value['imagename'] . '"><img src="' . IMAGE_PATH . $value['image'] . '" alt="' . $value['imagename'] . '" /></a>';
                echo '<div class="description">';
                echo '<p>' . $value['content'] . '</p>';
                echo '</div>';
                echo '<div class="link"><a href="' . $value['address'] . '" target="_blank">Zobacz online</a></div>';
                echo '</div>';
            }
        }
    }

    function checkActivePage($link) {
        $link2 = $_SERVER['PHP_SELF'];
        $how_much = strlen($link);
        $address = substr($link2, - $how_much);
        if ($address == $link) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function displayNavigation($type = 'normal') {

        if ($stmt = $this->AdamCms->Database->prepare("SELECT * FROM navigation WHERE type = ? ORDER BY id DESC")) {
            $stmt->bind_param('s', $type);
            $stmt->execute();
            $stmt->bind_result($id, $name, $address, $type);
            echo '<ul>';
            while ($stmt->fetch()) {
                if ($this->checkActivePage($address)) {
                    echo '<li class="active"><a href="' . SITE_PATH . $address . '">' . strtoupper($name) . '</a></li>';
                } else {
                    echo '<li><a href="' . SITE_PATH . $address . '">' . strtoupper($name) . '</a></li>';
                }
            }
            echo '</ul>';
        }
    }

    function sendMail($title, $email, $text) {
        $to = MAIL_PATH;

        $mailheader = "FROM: " . $email . "\n";

        $mailheader .= "MIME-Version: 1.0\n";

        $mailheader .= "Content-Type: text/html;\n";

        $mailheader .= "\tcharset=\"UTF-8\"\n";

        $mailheader .= "Content-Transfer-Encoding: 8bit\n\n";

        if (mail($to, $title, $text, $mailheader)) {
            $this->setAlert('Wiadomość zostałą wysłana', 'success');
        } else {
            $this->setAlert('Błąd w wysłaniu wiadomości', 'error');
        }
    }

    function selectInformations() {
        if ($stmt = $this->AdamCms->Database->query("SELECT * FROM description ORDER BY id")) {
            $stmt->fetch_array();
            echo '<table class="table_informations">';
            echo '<tr>';
            echo '<th>Id</th><th>Tresc</th><th>Typ</th><th>Edytowanie</th><th>Usuwanie</th>';
            echo '</tr>';
            foreach ($stmt as $value) {
                echo '<tr>';
                echo '<td>' . $value['id'] . '</td>' .
                '<td>' . $value['content'] . '</td>' .
                '<td>' . $value['type'] . '</td>' .
                '<td><a href="edit.php?id=' . $value['id'] . '">Edytuj</a></td>' .
                '<td><a href="delete.php?id=' . $value['id'] . '">Usuń</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    function chooseInformationsType() {
        echo '<select name="type">' .
        '<option>paragraph</option>' .
        '<option>list</option>' .
        '</select>';
    }

    function formInformations($id) {
        if ($stmt = $this->AdamCms->Database->prepare("SELECT * FROM description WHERE id = ? ORDER BY id")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($id, $content, $type);
            echo '<form action="" method="POST">';
            while ($stmt->fetch()) {

                echo '<p>Id ' . $id . '</p>';
                echo '<input class="hide" type="hide" name="id" value="' . $id . '" />';
                echo '<textarea name="content">' . $content . '</textarea></td><br />';

                echo '<p>' . $this->chooseInformationsType() . '</p>';
            }

            echo '<input type="submit" name="save" value="Zapisz" />';
            echo '<input type="submit" name="cancel" value="Powróc" />';
            echo '</form>';
        }
    }

    function formDeleteInformation($id) {
        if ($stmt = $this->AdamCms->Database->prepare("SELECT * FROM description WHERE id = ? ORDER BY id")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($id, $content, $type);
            echo '<form action="" method="POST">';
            while ($stmt->fetch()) {

                echo '<p>Id ' . $id . '</p>';
                echo '<input class="hide" type="hide" name="id" value="' . $id . '" />';
                echo '<p>' . $content . '</p>';

                echo '<p>' . $type . '</p>';
            }

            echo '<input type="submit" name="delete" value="Usuń" />';
            echo '<input type="submit" name="cancel" value="Powróć" />';
            echo '</form>';
        }
    }

    function formInsertInformation() {
        echo '<form action="" method="POST">';
        echo '<p>Treść</p>';
        echo '<textarea name="content"></textarea>';
        echo '<p>Typ</p>';
        echo '<p>' . $this->chooseInformationsType() . '</p>';

        echo '<input type="submit" name="insert" value="Dodaj" />';
        echo '<input type="submit" name="cancel" value="Powróć" />';
        echo '</form>';
    }

    function formInsertWork() {
        echo '<form enctype="multipart/form-data" method="POST" action="">';
        echo '<p><input type="file" name="image" /></p>';
        echo '<p>Zawartość</p><p><textarea name="content"></textarea></p>';
        echo '<p>Adres<input type="text" name="address" /></p>';
        echo '<p>Nazwa obrazu<input type="text" name="imagename" /></p>';
        echo '<p><input type="submit" name="insert" value="Dodaj" />';
        echo '<input type="submit" name="cancel" value="Powróć" /></p>';
        echo '</form>';
    }

    function formWork($id) {
        if ($stmt = $this->AdamCms->Database->prepare("SELECT * FROM works WHERE id = ? ORDER BY id")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($id, $content, $address, $image, $imagename);
            echo '<form enctype="multipart/form-data" method="POST" action="">';
            while ($stmt->fetch()) {
                echo '<p>Id ' . $id . '</p>';
                echo '<input type="hidden" name="id" value="' . $id . '" />';
                echo '<img src="' . IMAGE_PATH . $image . '" alt="' . $imagename . '" style="width: 500px;" />';
                echo '<input type="hidden" name="lastimage" value="' . $image . '" />';
                echo '<p><input type="file" name="image" /></p>';
                echo '<p>Zawartość</p><p><textarea name="content">' . $content . '</textarea></p>';
                echo '<p>Adres<input type="text" name="address" value="' . $address . '" /></p>';
                echo '<p>Nazwa obrazu<input type="text" name="imagename" value="' . $imagename . '"/></p>';
            }

            echo '<input type="submit" name="save" value="Zapisz" />';
            echo '<input type="submit" name="cancel" value="Powróc" />';
            echo '</form>';
        }
    }

    function formdeleteWork($id) {
        if ($stmt = $this->AdamCms->Database->prepare("SELECT * FROM works WHERE id = ? ORDER BY id")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($id, $content, $address, $image, $imagename);

            while ($stmt->fetch()) {
                echo '<div class="my_work">';
                echo '<a href="' . IMAGE_PATH . $image . '" data-lightbox="Work1" data-title="' . $imagename . '"><img src="' . IMAGE_PATH . $image . '" alt="' . $imagename . '" /></a>';
                echo '<div class="description">';
                echo '<p>' . $content . '</p>';
                echo '</div>';
                echo '<div class="link"><a href="' . $address . '">Zobacz online</a></div>';
                echo '</div>';
            }
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="id" value="' . $id . '" />';
            echo '<input type="hidden" name="image" value="' . $image . '" />';
            echo '<input type="submit" name="delete" value="Usuń" />';
            echo '<input type="submit" name="cancel" value="Powróć" />';
            echo '</form>';
        }
    }

    function selectWorks() {

        if ($stmt = $this->AdamCms->Database->query("SELECT * FROM works ORDER BY id")) {
            $stmt->fetch_array();
            foreach ($stmt as $value) {
                echo '<div class="my_work">';
                echo '<a href="' . IMAGE_PATH . $value['image'] . '" data-lightbox="Work1" data-title="' . $value['imagename'] . '"><img src="' . IMAGE_PATH . $value['image'] . '" alt="' . $value['imagename'] . '" /></a>';
                echo '<div class="description">';
                echo '<p>' . $value['content'] . '</p>';
                echo '</div>';
                echo '<div class="link"><a href="' . $value['address'] . '">Zobacz online</a> '
                . '<a href="workedit.php?id=' . $value['id'] . '">Edytuj</a> '
                . '<a href="workdelete.php?id=' . $value['id'] . '">Usuń</a></div>';

                echo '</div>';
            }
        }
    }

}
