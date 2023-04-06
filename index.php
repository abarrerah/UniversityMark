<?php
require __DIR__ . "/inc/bootstrap.php";
require __DIR__ . "/Helpers/ArrayHelper.php";


$parseUri = ArrayHelper::getValue($_SERVER, 'REQUEST_URI');
$uri = parse_url($parseUri, PHP_URL_PATH);
$uri = explode( '/', $uri );
if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
$objFeedController = new UserController();
$strMethodName = $uri[3] . 'Action';
$objFeedController->{$strMethodName}();
?>

