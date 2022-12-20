<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//- в корні додатку вже має бути ініціалізований git, та налагоджений зв'язок між віддаленим сервером git
//- користувач серверу www-data має бути owner додатку.
// Для цього виконайте команду в терміналі:
// sudo chown -R www-data $_SERVER["DOCUMENT_ROOT"]."/каталог-додатку

include 'Update.php';
$params = include 'settings_default.php';
$root = $params['root'];
$sqlFolder = $params['sqlFolder'];
$db_conf = $params['db_conf'];
$db_table_version = $params['db_table_version'];

////*Check data*/
////***********/

/**Перевіряємо чи передана нам гілка*/
$isSetBranch = isset($_POST) && isset($_POST['branch']) && !empty($_POST['branch'] );
//Якщо гілку не передали виходимо
if (!$isSetBranch && !isset($_POST['getLocalBranches'])) {
    echo 'Гілка не зазначена'.PHP_EOL.PHP_EOL;
    exit;
}
/**Встановлюємо гілку*/
$branch = htmlspecialchars($_POST['branch']);

/**Перевіряємо чи передано корінь сайту*/
if (!is_dir($root)){
    echo 'Корінь сайту не визначено'.PHP_EOL.PHP_EOL;
    exit;
}
/**Перевіряємо можливість робити записи в корінь сайту*/
if (!is_writable($root)){
    echo 'У вас не вистачає прав на оновення платформи.'.PHP_EOL.
        ' Потрібно зробити користувачу www-data доступ до зміни данних'.PHP_EOL.PHP_EOL;
    exit;
}

/**Перевіряємо чи передано шлях до папки з міграціями*/
if (!is_dir($sqlFolder)){
    echo "Папки для оновлень {$sqlFolder} не існує".PHP_EOL.PHP_EOL;;
    exit;
}
/**Перевіряємо можливість робити записи в папку з міграціями*/
if (!is_writable($sqlFolder)){
    echo 'У вас не вистачає прав на оновення папки з міграціями'.PHP_EOL.PHP_EOL;
    exit;
}

////*Do Work*/
////***********/
$update = new \update\migration\Update($db_conf, $db_table_version, $root, $branch, $sqlFolder);

if (isset($_POST['check'])) {
    echo $update->checkNewVersion();
    exit;
}
if (isset($_POST['run'])) {
    echo $update->runMigrate();
    exit;
}
//if (isset($_POST['getLocalBranches'])) {
//    $update->getAllLocalBranches();
//    exit;
//}
if (isset($_POST['goToBranch'])) {
    //copy($_SERVER["DOCUMENT_ROOT"].'/core/db_default.php', $_SERVER["DOCUMENT_ROOT"].'/core/db.php');
    echo $update->checkoutToBranch($branch);
    exit;
}

echo 'Пост запити не оброблено. Це пост запит: '.PHP_EOL.print_r($_POST).PHP_EOL.PHP_EOL;
exit;
