<?php

class UsersModel extends Model
{
    public function getUserByLoin($login)
    {
        $strQuery = "SELECT * FROM users WHERE login = ? ";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}