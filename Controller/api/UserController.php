<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Base/View.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Response.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/UserModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Helpers/ArrayHelper.php";

class UserController extends BaseController
{
    public function loginAction()
    {
        session_start();
        $viewModel = new View('Login');
        echo $viewModel->render([]);
    }

    public function registAction()
    {
        try {
            session_start();
            $viewModel = new View('Regist');
            echo $viewModel->render([]);
        } catch (Exception $e) {
            echo Response::getHttpCodeMessage(http_response_code(), $e->getMessage());
        }
    }

    public function registerAction()
    {
        $params = $_POST;
        $email = ArrayHelper::getValue($params, 'email');
        try {
            $userModel = new UserModel();

            $userExist = $userModel->userExists($email);
            if ($userExist) {
                json_encode(Response::getHttpCodeMessage(409));
            } else {
                $password = ArrayHelper::getValue($params, 'password');
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $userContent = [
                    'name' => ArrayHelper::getValue($params, 'name'),
                    'surname' => ArrayHelper::getValue($params, 'surname'),
                    'email' => $email,
                    'password' => $hashedPassword,
                    'birthDate' => ArrayHelper::getValue($params, 'birthDate'),
                    'phone' =>  ArrayHelper::getValue($params, 'phone')
                ];
                $userModel->load($userContent);
                $result = $userModel->save();
                if ($result) {
                    echo json_encode(Response::getHttpCodeMessage(201));
                }
            }
        } catch (Exception $e) {
            echo json_encode(Response::getHttpCodeMessage(http_response_code(), $e->getMessage()));
        }
    }
}
