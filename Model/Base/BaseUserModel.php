<?php 
require_once PROJECT_ROOT_PATH . "/Model/Base/Database/Database.php";

class BaseUserModel Extends Database 
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}
?>