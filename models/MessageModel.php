<?php

class MessageModel extends Model
{
    public function save($data, $dataId = 0)
    {
        if (isset($data['email']) && isset($data['name']) && isset($data['message'])
        && !empty($data['email']) && !empty($data['name']) && !empty($data['message'])) {
            if ($dataId) {
                $strQuery = 'UPDATE messages SET name = ?, email = ?, message = ? WHERE id = ?';
                $dbValues  = array($data['name'], $data['email'], $data['message'], $dataId);
            }
            else {
                $strQuery = 'INSERT INTO messages(`name`, `email`, `message`) VALUES(?,?,?)';
                $dbValues = array($data['name'], $data['email'], $data['message']);
            }
            $stmt = $this->db->prepare($strQuery);
            $stmt->exec($dbValues);
            $this->db->commit();
            $id = $this->db->lastInsertId();

            return $id;
        }
        return false;
    }
}