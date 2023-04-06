<?php 
require_once PROJECT_ROOT_PATH . "/Model/Base/Database/Database.php";

class BaseUserModel Extends Database 
{
    public function getUsers($limit = null)
    {
        $queryString = "SELECT * FROM users ORDER BY user_id ASC";
        $queryParams = [];
        if (!empty($limit)) {
            $queryString .= " LIMIT ?";
            $queryParams = ["i", $limit];
        }
        return $this->select($queryString, $queryParams);

    }
}
?>