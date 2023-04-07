<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/Model/Base/BaseResponse.php";

class Response extends BaseResponse {
    
    public static $response = [
        'status' => '',
        "result" => ''
    ];

    public static function getHttpCodeMessage($code, $message = null) 
    {
        Response::$response['status'] = $code;
        if (!empty($message)) {
            Response::$response['result'] = $message;
        }
        Response::$response['result'] = Response::getHttpCodeResult($code);
        return Response::$response;
    }

    private static function getHttpCodeResult($code) {
        $fooClass = new ReflectionClass ('Response');
        $constants = $fooClass->getConstants();
        $constName = null;
        foreach ( $constants as $name => $value){
            if ($value == $code){
                $constName = $name;
                break;
            }
        }
        return $constName;
    }
}
?>