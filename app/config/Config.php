<?php
// Base URL
define('BASEURL', 'http://localhost:8080/art-now/public');
define('NOWURL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

// Connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'art_now');

date_default_timezone_set("Asia/Jakarta");
setlocale(LC_TIME, 'id_id');
