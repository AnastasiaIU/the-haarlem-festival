<?php

require_once (__DIR__ . '/../enums/UserRole.php');

/**
 * Data Transfer Object (DTO) for representing a user.
 */
class UserDTO
{
    public int $id;
    private string $email;
    private string $password;
    private UserRole $role;

    public function __construct(string $id, string $email, string $password, UserRole $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getRole(): UserRole {
        return $this->role;
    }

    /**
     * Verifies if the provided password matches the stored hashed password.
     *
     * @param string $password The plain text password to verify.
     * @return bool True if the password matches, false otherwise.
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    /**
     * Converts the UserDTO object to an associative array.
     *
     * @return array An associative array representing the UserDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'role' => $this->role->value
        ];
    }

    /**
     * Creates a UserDTO instance from an associative array.
     *
     * @param array $data The associative array containing user data.
     * @return self A new instance of UserDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['email'],
            $data['password'],
            UserRole::from($data['role'])
        );
    }
}