<?php

/**
 * Class AuthHandler for handling user authentication.
 */
class AuthHandler
{
    /**
     * Checks if the user is logged in.
     *
     * This method verifies if the user session is set. If the user is not logged in,
     * it redirects to the login page and terminates the script execution.
     */
    public static function checkUserLoggedIn(): void
    {
        if (!isset($_SESSION['user'])) {
            // If not logged in, redirect to the login page
            header("Location: /login");
            exit();
        }
    }

    /**
     * Checks if an admin is logged in.
     *
     * This method verifies if the user is admin. If the user is not logged in as an admin,
     * it terminates the script execution.
     */
    public static function checkAdminLoggedIn(): void
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Administrator') {
            exit();
        }
    }

    /**
     * Returns whether the current user is an administrator.
     *
     * @return bool True if the user is an admin, false otherwise.
     */
    public static function isAdmin(): bool
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Administrator';
    }
}