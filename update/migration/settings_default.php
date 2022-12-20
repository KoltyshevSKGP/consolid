<?php

$root = $_SERVER['DOCUMENT_ROOT']; //заповнити. Наприклад $_SERVER["DOCUMENT_ROOT"]."/sandbox/leodemo
$sqlFolder = rtrim($root, '/') . '/update/migration/migrationSQL';
$db_conf = [
    'host' => '142.93.35.175', //     * 'host' - хост підключення до бази данних MySQL,
    'user' => 'admin', //     * 'user' - user name для підключення до бази данних MySQL,
    'pass' => 'e2f22ed749990bffe7e68bb30e1fbcd47506bbcf8c09095b', //     * 'pass' - пароль для підключення до бази данних MySQL,
    'db' => "consolid_app",   //     * 'db' - назва бази данних MySQL
];

$db_table_version = 'db_version'; //Назва таблиці з міграціями в базі данних(яку шукати або створити)
return compact('root', 'sqlFolder', 'db_conf', 'db_table_version');