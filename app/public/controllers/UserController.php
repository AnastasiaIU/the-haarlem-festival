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
     * @param UserRole $userRole The role of the user to register.
     * @return UserDTO|null The newly created UserDTO object or null if the user already exists.
     */
    public function registerUser(string $email, string $password, UserRole $userRole): ?UserDTO
    {
        // Retrieve the user by email
        $user = $this->userModel->getUser($email);

        // Check if the user already exists
        if ($user !== null) {
            // Set error message and form data in session
            $_SESSION['error'] = 'User already exists. Please use another email.';
            $_SESSION['form_data'] = ['email' => $email];
            http_response_code(400);
        } else {
            // Hash the password and save the user to the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $new_user = $this->userModel->createUser($email, $hashedPassword, $userRole);

            $_SESSION['login_user_created'] = 'User created successfully. Please log in.';
            header('Location: /login');

            return $new_user;
        }

        return null;
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
     * @return UserDTO|null The UserDTO object if login is successful, or null if login fails.
     */
    public function attemptLogin(string $email, string $password): ?UserDTO
    {
        // Retrieve the user by email
        $user = $this->userModel->getUser($email);

        // Check if the user exists
        if ($user === null) {
            $this->setErrorMessageInSession($email, $password);
        } else {
            if ($user->verifyPassword($password)) {
                // Set logged-in user in session
                $_SESSION['user'] = $user->id;

                // Redirect to the last visited page or default to profile page
                $redirectUrl = $_SESSION['last_visited_url'] ?? '/profile';
                header("Location: $redirectUrl");
                return $user;
            } else {
                $this->setErrorMessageInSession($email, $password);
            }
        }

        return null;
    }

    /**
     * Sets an error message and form data in the session.
     *
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     */
    public function setErrorMessageInSession(string $email, string $password): void
    {
        $_SESSION['login_error'] = 'Wrong email or password. Please, try again.';
        $_SESSION['login_form_data'] = ['email' => $email, 'password' => $password];
        http_response_code(400);
    }
}
