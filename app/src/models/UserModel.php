<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/UserDTO.php');
require_once(__DIR__ . '/../enums/UserRole.php');

/**
 * UserModel class extends BaseModel to interact with the USER entity in the database.
 */
class UserModel extends BaseModel
{
    /**
     * Retrieves a user by their email.
     *
     * @param string $email The email of the user to retrieve.
     * @return UserDTO|null The data transfer object representing the user or null if the user is not found.
     * @throws DateMalformedStringException
     */
    public function getUser(string $email): ?UserDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, email, password, role, created_at, name
                    FROM user
                    WHERE email = :email'
        );
        $query->execute([':email' => $email]);
        $item = $query->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            return null;
        }

        return UserDTO::fromArray($item);
    }

    /**
     * Creates a new user in the database.
     *
     * @param string $email The email of the new user.
     * @param string $hashedPassword The already hashed password.
     * @param UserRole $role The role of the new user.
     * @param string $name The name of the new user.
     */
    public function createUser(string $email, string $hashedPassword, UserRole $role, string $name): void
    {
        try {
            self::$pdo->beginTransaction();

            $query = self::$pdo->prepare(
                'INSERT INTO user (email, password, role, created_at, name) VALUES (:email, :password, :role, NOW(), :name)'
            );

            $success = $query->execute([
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role->value,
                ':name' => $name
            ]);

            if (!$success) {
                self::$pdo->rollBack(); // Revert changes if insertion fails
                exit;
            }

            // Commit the transaction
            self::$pdo->commit();
        } catch (Exception $e) {
            self::$pdo->rollBack(); // Ensure rollback in case of failure
        }
    }

    public function getAllUsers() : array{
        $query = self::$pdo->prepare(
            'SELECT id, email, password, role, created_at, name FROM user'
        );
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($users as $user) {
            $dto = UserDTO::fromArray($user);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    public function deleteUser(int $id): bool{
        $query = self::$pdo->prepare("DELETE FROM user WHERE id = :id");
        return $query->execute([':id' => $id]);
    }

    public function updateUserRole(int $id, UserRole $newRole): bool{
        $query = self::$pdo->prepare("UPDATE user SET role = :role WHERE id = :id");
        return $query->execute([
            ':role' => $newRole->value, 
            ':id' => $id
        ]);
    }

    public function updateUserEmail(int $id, string $newEmail): bool{
        $query = self::$pdo->prepare("UPDATE user SET email = :email WHERE id = :id");
        return $query->execute([':email' => $newEmail, ':id' => $id]);
    }

    public function updateUserName(int $id, string $newName): bool {
        $query = self::$pdo->prepare("UPDATE user SET name = :name WHERE id = :id");
        return $query->execute([':name' => $newName, ':id' => $id]);
    }

    public function getUserInfoById(int $id): ?array {
        $query = self::$pdo->prepare('SELECT email, name FROM user WHERE id = :id');
        $query->execute([':id' => $id]);
        $item = $query->fetch(PDO::FETCH_ASSOC);
    
        return $item ?: null;
    }

    public function updateUserProfile(int $id, array $updates): bool {
        $fields = [];
        $values = [];

        foreach ($updates as $key => $value) {
            $fields[] = "$key = :$key";
            $values[":$key"] = $value;
        }

        if (empty($fields)) {
            return false;
        }

        $values[':id'] = $id;
        $query = self::$pdo->prepare("UPDATE user SET " . implode(", ", $fields) . " WHERE id = :id");

        return $query->execute($values);
    }
}