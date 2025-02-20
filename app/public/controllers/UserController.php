<?php

require_once(__DIR__ . "/../models/UserModel.php");

/**
 * Controller class for handling user-related operations.
 */
class UserController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getAll()
    {
        return $this->userModel->getAll();
    }

    public function get($id)
    {
        return $this->userModel->get($id);
    }
}
