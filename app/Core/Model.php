<?php

namespace App\Core;

use PDO;

class Model {
    protected $table = '';
    public $username;
    public $email;
    public $password;
    public $role;
    
    public function getTable() {
        return $this->table;
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $query = $db->getConnection()->prepare("SELECT * FROM " . (new static())->getTable() . " WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchObject('App\Models\\' . (new static())->getTable());
    }
}
