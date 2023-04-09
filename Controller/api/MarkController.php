<?php

use JetBrains\PhpStorm\ArrayShape;

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Base/View.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Response.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Helpers/ArrayHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/UserModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/MarkModel.php";

class MarkController extends BaseController
{
    public function marksAction()
    {
        session_start();
        if (!empty($_COOKIE)) {
            $viewModel = new View('Mark');
            $user = new UserModel();
            $userModel = $user->getUser($_SESSION['email']);
            
            $markModel = new MarkModel();
            $userId = ArrayHelper::getValue($userModel, 'id');
            $totalMark = $markModel->getAllMarksFromUser($userId);
            $countMark = $markModel->countAllMarksFromUser($userId);
            $avgMark = $markModel->averageMarksFromUser($userId);

            echo $viewModel->render([
                'totalMark' => $totalMark,
                'countMark' => $countMark['totalCounts'],
                'avgMark' => $avgMark['avgMarks'] 
            ]);
        }
    }

    public function ajaxGetFormAction()
    {
        if (!empty($_COOKIE)) {
        $viewModel = new View('_form-mark');
        echo $viewModel->renderPartial([]);
        }
    }

    public function ajaxSaveNewMarkAction()
    {
        session_start();
        if (!empty($_COOKIE)) {
            try {
                $params = $_POST;
                $user = new UserModel();
                $userModel = $user->getUser($_SESSION['email']);
                if (!empty($params) && !empty($userModel)) {
                    $markParams = [
                        'userId' => ArrayHelper::getValue($userModel, 'id'),
                        'mark' => ArrayHelper::getValue($params, 'mark')
                    ];
                    $markModel = new MarkModel();
                    $markModel->load($markParams);
                    $result = $markModel->save();
                    if ($result) {
                        echo json_encode(Response::getHttpCodeMessage(201));
                    }
                }
            } catch (Exception $e) {
                echo json_encode(Response::getHttpCodeMessage(401, $e->getMessage()));
            }
        }
    }
}
