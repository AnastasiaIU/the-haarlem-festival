<?php

require_once(__DIR__ . "/../models/UserModel.php");
require_once(__DIR__ . '/../dto/UserDTO.php');
require_once(__DIR__ . '/../enums/UserRole.php');

/**
 * Controller class for handling user-related operations.
 */
class UserController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Registers a new user.
     *
     * This method checks if a user with the given email already exists. If the user exists,
     * it sets an error message and form data in the session and returns null. If the user
     * does not exist, it hashes the password, creates a new user, sets a success message
     * in the session, and redirects to the login page.
     *
     * @param string $email The email of the user to register.
     * @param string $password The password of the user to register.
     * @throws DateMalformedStringException
     */
    public function registerUser(string $email, string $password, string $recaptchaToken): void
    {
        $secretKey = $_ENV['RECAPTCHA_SECRET_KEY'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaToken";
        $response = file_get_contents($url);
        $response = json_decode($response);
        if ($response->success) {
            // Retrieve the user by email
            $user = $this->userModel->getUser($email);

            // Check if the user already exists
            if ($user !== null) {
                http_response_code(400);
                echo json_encode(['user_error' => 'User already exists. Please use another email.']);
                exit;
            }

            // Hash the password and save the user to the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->createUser($email, $hashedPassword, UserRole::CUSTOMER);

            $_SESSION['login_user_created'] = 'User created successfully. Please log in.';

            http_response_code(200);
            echo json_encode(['success' => 'User created successfully. Please log in.']);
        } else {
            http_response_code(400);
            echo json_encode(['captcha_error' => 'Please complete the captcha.']);
        }
    }

    /**
     * Attempts to log in a user with the provided email and password.
     *
     * This method retrieves the user by email, verifies the password, and if successful,
     * sets the user ID in the session and redirects to the last visited page. If the user does not
     * exist or the password is incorrect, it sets an error message and form data in the session.
     *
     * @param string $email The email of the user attempting to log in.
     * @param string $password The password of the user attempting to log in.
     * @throws DateMalformedStringException
     */
    public function attemptLogin(string $email, string $password): void
    {
        // Retrieve the user by email
        $user = $this->userModel->getUser($email);

        // Check if the user exists
        if ($user === null || !$user->verifyPassword($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'Wrong email or password. Please, try again.']);
            exit;
        }

        $_SESSION['user'] = $user->getId();
        $_SESSION['user_role'] = $user->getRole()->value;

        $redirectUrl = $_SESSION['last_visited_url'] ?? '/profile';
        echo json_encode(['redirectUrl' => $redirectUrl]);
    }

    public function getAllUsers() : array{
        return $this->userModel->getAllUsers(); 
    }

    public function deleteUser(int $id): bool{
        return $this->userModel->deleteUser($id);
    }

    public function updateUserRole(int $id, UserRole $newRole){
        return $this->userModel->updateUserRole($id, $newRole);
    }

    public function updateUserEmail(int $id, string $newEmail){
        return $this->userModel->updateUserEmail($id, $newEmail);
    }

    public function createUser(string $email,string $password, UserRole $newRole){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->createUser($email, $hashedPassword, $newRole);
    }

    public function getUserEmailById(): array {        
        return $this->userModel->getUserEmailById($_SESSION['user']);
    }

    public function updateUserProfile($updates) {
        return $this->userModel->updateUserProfile($_SESSION['user'], $updates);
    }
}
