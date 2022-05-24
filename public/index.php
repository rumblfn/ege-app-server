<?php 

use app\engine\App;

$config = include "../config/config.php";
require_once '../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

try {
    App::call()->run($config);
} catch (PDOException $exception) {
    var_dump($exception->getMessage());
} catch (Exception $exception) {
    var_dump($exception);
}
