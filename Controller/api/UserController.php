<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Base/View.php";

class UserController extends BaseController
{
    public function loginAction()
    {
        session_start();
        if (!empty($_POST["login"])) {

        }
    }

    public function registAction()
    {
        try {

        } catch (Exception $e) {
            
        }
        session_start();
        $viewModel = new View(False);
        if (!empty($_POST["regist"])) {

            return '';
        } else {
            $str = "hola desde el action";
            $viewModel = new View('Regist');
            echo $viewModel->render(["str" => $str]);
        }
    }

    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getUsers($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}