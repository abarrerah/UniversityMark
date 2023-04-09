<?php 
require_once PROJECT_ROOT_PATH . "/Model/Base/Database/Database.php";


class BaseMarkModel extends Database
{
    private $studentId;
    private $mark;

    public function load($body = [])
    {
        if (!empty($body)) {
            $this->studentId = $body['studentId'];
            $this->mark = $body['mark'];
        }
    }
    
    public function getAllMarksFromUser($studentId)
    {
        $queryString = "SELECT mark FROM marks WHERE student_id = '{$studentId}'";
        $query = $this->select($queryString);
        return $query;
    }

    public function countAllMarksFromUser($studentId)
    {
        $queryString = "SELECT COUNT(student_id) as totalCounts FROM marks WHERE student_id = '{$studentId}' ";
        $query = $this->select($queryString);
        return $query[0];
    }

    public function averageMarksFromUser($studentId)
    {
        $queryString = "SELECT AVG(mark) as avgMarks FROM marks WHERE student_id = '{$studentId}' ";
        $query = $this->select($queryString);
        return $query[0];
    }

    public function save()
    {
        $studentId = $this->studentId;
        $mark = $this->mark;
        $queryString = "INSERT INTO marks (student_id, mark) VALUES ('$studentId', '$mark')";
        $query = $this->selectSave($queryString);
        return json_encode($query);
    }
}

?>