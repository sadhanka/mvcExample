<?php
/**
 * Created by PhpStorm.
 * User: Lyubov Zhurba
 * Date: 21.07.2017
 * Time: 19:29
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('DIR', dirname(__DIR__));

require_once(ROOT . DS . 'lib' . DS . 'init.php');

$uri = $_SERVER['REQUEST_URI'];

App::run($uri);

$db = DB::getInstance();
$strQuery = "SELECT * FROM pages WHERE is_published = ? ";

$stmt = $db->prepare($strQuery);


$stmt->execute([1]);

$pagesArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($pagesArray);