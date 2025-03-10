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
     */
    public function getUser(string $email): ?UserDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, email, password, role
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
     * @return UserDTO|null The created user as a DTO or null if creation fails.
     */
    public function createUser(string $email, string $hashedPassword, UserRole $role): ?UserDTO
    {
        try {
            self::$pdo->beginTransaction();

            $query = self::$pdo->prepare(
                'INSERT INTO user (email, password, role) VALUES (:email, :password, :role)'
            );

            $success = $query->execute([
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role->value
            ]);

            if (!$success) {
                self::$pdo->rollBack(); // Revert changes if insertion fails
                return null;
            }

            // Retrieve the last inserted ID within the transaction
            $userId = self::$pdo->lastInsertId();

            // Commit the transaction
            self::$pdo->commit();

            return UserDTO::fromArray([
                'id' => $userId,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role->value
            ]);

        } catch (Exception $e) {
            self::$pdo->rollBack(); // Ensure rollback in case of failure
            return null;
        }
    }
}