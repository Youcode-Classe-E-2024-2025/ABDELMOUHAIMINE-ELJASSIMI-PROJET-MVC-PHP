<?php

namespace App\Models;

use App\Core\Database;
use App\Core\model;

class Article extends Model {
    protected $table = 'articles';
    public $title;
    public $description;

    public function save()
    {
        $db = Database::getInstance();
        $query = $db->getConnection()->prepare("INSERT INTO " . $this->getTable() . " (title, description) VALUES (:title, :description)");
        $query->bindParam(':title', $this->title);
        $query->bindParam(':description', $this->description);
        
        if ($query->execute()) {
            return $db->getConnection()->lastInsertId();
        } else {
            return false;
        }
    }
    
}
