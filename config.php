<?php

define("HOST","localhost");
define("USER","root");
define("PASS","");
define("DB","id8260745_schedule");

$db = mysqli_connect(HOST, USER, PASS, DB) or die('Нет соединения с БД');
mysqli_set_charset($db, 'utf8') or die('Не установлена кодировка соединения');
