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

    public function save($data, $dataId = 0)
    {
        if (isset($data['alias']) && isset($data['title']) && isset($data['content'])
            && !empty($data['alias']) && !empty($data['title']) && !empty($data['content'])) {
            $published = !empty($data['published']) ? 1 : 0;
            if ($dataId) {
                $strQuery = 'UPDATE pages SET alias = ?, title = ?, content = ?, is_published = ? WHERE id = ?';
                $dbValues  = array($data['alias'], $data['title'], $data['content'], $published, $dataId);
            }
            else {
                $strQuery = 'INSERT INTO pages(`alias`, `title`, `content`, `is_published`) VALUES(?,?,?,?)';
                $dbValues = array($data['alias'], $data['title'], $data['content'], $published);
            }
            $stmt = $this->db->prepare($strQuery);
            $stmt->execute($dbValues);
            $this->db->commit();
            $id = $this->db->lastInsertId();

            return $id;
        }
        return false;
    }

    public function delete($pageId)
    {
        if (!empty($pageId) && is_numeric($pageId)) {
            $strQuery = "DELETE FROM pages WHERE id = ?";
            $stmt = $this->db->prepare($strQuery);
            $stmt->execute([$pageId]);
            return $this->db->commit();
        }
        return false;
    }
}