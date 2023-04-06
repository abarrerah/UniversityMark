<?php 

require __FILE__ . "/Base/BaseResponse.php";

class Response extends BaseResponse {
    
    public $response = [
        'status' => '',
        "result" => ''
    ];

    public static function getHttpCodeMessage($code) 
    {
        Response::$response['status'] = $code;
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