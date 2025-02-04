<?php

namespace App\Models;

use App\Core\Database;
use App\Core\model;

class User extends Model {
    protected $table = 'users';

    public static function findByEmail($email){
        $db = Database::getInstance();
        $query = $db->getConnection()->prepare("SELECT * FROM " . (new static())->getTable() . " WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchObject('App\Models\User');
    }

    public function save()
    {
        $db = Database::getInstance();
        $query = $db->getConnection()->prepare("INSERT INTO " . $this->getTable() . " (username, email, password, role_id) VALUES (:username, :email, :password, :role)");
        $query->bindParam(':username', $this->username);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':role', $this->role);
        
        if ($query->execute()) {
            return $db->getConnection()->lastInsertId();
        } else {
            return false;
        }
    }
}
