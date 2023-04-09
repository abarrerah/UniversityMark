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

    public function signinAction()
    {
        session_start();
        $params = $_POST;
        try {
            $email = ArrayHelper::getValue($params, 'email');
            $recievedPassword = ArrayHelper::getValue($params, 'password');
            $userModel = new UserModel();
            $userExist = $userModel->userExists($email);
            if ($userExist) {
                $user = $userModel->getUser($email);
                $userPassword = ArrayHelper::getValue($user, 'password');
                $checkPassword = password_verify($recievedPassword, $userPassword);
                if ($checkPassword) {
                    setcookie("user$email", $email, time() + (86400 * 30));
                    $_SESSION['email'] = $email;
                    echo json_encode(Response::getHttpCodeMessage(200));
                } else {
                    $_SESSION['message'] = "Login failed. Wrong password.";
                    echo json_encode(Response::getHttpCodeMessage(403));
                }
            } else {
                $_SESSION['message'] = "Login Failed. User not Found.";
                echo json_encode(Response::getHttpCodeMessage(403));
            }

        } catch(Exception $e){
            echo json_encode(Response::getHttpCodeMessage(http_response_code(), $e->getMessage()));
        }
    }

    public function logoutAction()
    {
        if (isset($_COOKIE["user"]) AND isset($_COOKIE["pass"])){
            setcookie("user", '', time() - (86400 * 30));
            setcookie("pass", '', time() - (86400 * 30));
        }
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
        
        try {
            $email = ArrayHelper::getValue($params, 'email');
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
