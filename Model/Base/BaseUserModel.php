<?php 
require_once PROJECT_ROOT_PATH . "/Model/Base/Database/Database.php";

class BaseUserModel Extends Database 
{
    private $name;
    private $surname;
    private $password;
    private $birthDate;
    private $email;
    private $phone;

    public function load($body = [])
    {
        if (!empty($body)) {
            $this->name = $body['name'];
            $this->surname = $body['surname'];
            $this->password = $body['password'];
            $this->birthDate = $body['birthDate'];
            $this->email = $body['email'];
            $this->phone = $body['phone'];
        }
    }

    public function userExists($email)
    {
        $queryString = "SELECT EXISTS(SELECT * FROM student WHERE email = '{$email}') AS 'exists'";
        $query = $this->select($queryString);
        return $query[0]['exists'];
    }

    public function getUser($email)
    {
        $queryString = "SELECT * FROM student WHERE email = '{$email}'";
        $query = $this->select($queryString);
        return $query[0];
    }

    public function save()
    {
        $name = $this->name;
        $surname = $this->surname; 
        $password = $this->password;
        $birthDate = date('Y-m-d', strtotime($this->birthDate));
        $email = $this->email;
        $phone = $this->phone; 
        $queryString = "INSERT INTO student (name, surname, password, birth_date, email, phone) VALUES ('$name', '$surname', '$password', $birthDate, '$email', '$phone')";
        $query = $this->selectSave($queryString);
        return json_encode($query);
    }
}
?>