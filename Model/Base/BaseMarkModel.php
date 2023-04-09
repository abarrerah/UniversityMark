<?php 
require_once PROJECT_ROOT_PATH . "/Model/Base/Database/Database.php";


class BaseMarkModel extends Database
{
    private $userId;
    private $mark;

    public function load($body = [])
    {
        if (!empty($body)) {
            $this->userId = $body['userId'];
            $this->mark = $body['mark'];
        }
    }
    
    public function getAllMarksFromUser($userId)
    {
        $queryString = "SELECT mark FROM marks WHERE user_id = '{$userId}'";
        $query = $this->select($queryString);
        return $query;
    }

    public function countAllMarksFromUser($userId)
    {
        $queryString = "SELECT COUNT(user_id) as totalCounts FROM marks WHERE user_id = '{$userId}' ";
        $query = $this->select($queryString);
        return $query[0];
    }

    public function averageMarksFromUser($userId)
    {
        $queryString = "SELECT AVG(mark) as avgMarks FROM marks WHERE user_id = '{$userId}' ";
        $query = $this->select($queryString);
        return $query[0];
    }

    public function save()
    {
        $userId = $this->userId;
        $mark = $this->mark;
        $queryString = "INSERT INTO marks (user_id, mark) VALUES ('$userId', '$mark')";
        $query = $this->selectSave($queryString);
        return json_encode($query);
    }
}

?>