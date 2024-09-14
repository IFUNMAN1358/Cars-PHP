<?php

namespace src\repository;

use PDO;
use src\model\User;
use Exception;

class UserRepository
{
    /**
     * @throws Exception
     */
    public function saveUser(User $user) {
        $pdo = connect_db();
        $sql = "INSERT INTO users (first_name, last_name, phone, email, password) 
                VALUES (:first_name, :last_name, :phone, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $user->getFirstName(),
            ':last_name' => $user->getLastName(),
            ':phone' => $user->getPhone(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
        ]);

        $id = $pdo->lastInsertId();
        return $this->getUserById($id);
    }

    /**
     * @throws Exception
     */
    function getUserById($userId) {
        $pdo = connect_db();
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}