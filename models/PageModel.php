<?php

class PageModel extends Model
{
    public function pagesList($defaultVisibility = 1)
    {
        $strQuery = "SELECT * FROM pages WHERE is_published = ? ";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([$defaultVisibility]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPage($alias)
    {
        $strQuery = "SELECT * FROM pages WHERE alias = ? ";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([$alias]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPagesById($id = 0)
    {
        $strQuery = "SELECT * FROM pages WHERE id = ? ";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}