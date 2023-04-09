<?php
require __DIR__ . "/inc/bootstrap.php";
require __DIR__ . "/Helpers/ArrayHelper.php";


$parseUri = ArrayHelper::getValue($_SERVER, 'REQUEST_URI');
$uri = parse_url($parseUri, PHP_URL_PATH);
$uri = explode( '/', $uri );


$validUri = [
    'user' => ' user',
    'mark' => 'mark'
];

$key = ArrayHelper::getValue($validUri, $uri[2]);
if ((isset($uri[2]) && empty($key)) || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

switch ($key) {
    default:
        require_once PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
        $objFeedController = new UserController();
        break;
    case 'mark':
        require_once PROJECT_ROOT_PATH . "/Controller/Api/MarkController.php";
        $objFeedController = new MarkController();  
        break;    
}

$strMethodName = $uri[3] . 'Action';
$objFeedController->{$strMethodName}();
?>

