<?php

define("SITE_PATH","http://adam-zadania.cba.pl/Portfolio/");
define("APP_PATH",str_replace("\\", "/", dirname(__FILE__)) . "/");
define("IMAGE_PATH", SITE_PATH . "images/");
define("MAIL_PATH", "aszulist@o2.pl");


$server = 'eu-cdbr-azure-north-d.cloudapp.net';
$user = 'a.szulist@dawidrza.com';
$pass = 'undercover123';
$db = 'portfolio';

require_once(APP_PATH."core/core.php");
$AdamCms = new adamCms($server,$user,$pass,$db);
