<?php
require_once(__DIR__.'/../../src/controllers/UserController.php');

Route::add('/api/getUsers', function(){
    $userController = new UserController();
    $users = $userController->getAllUsers();
    $userArray = array_map(function($user) {
        return $user->toArray();
    }, $users);
    echo json_encode($userArray);
});

Route::add('/api/deleteUser', function() {
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'])) {
            $deleted = $userController->deleteUser($data['id']);
            echo json_encode(["success" => $deleted]);
        } else {
            echo json_encode(["error" => "User ID is required"]);
        }
    }
}, 'delete');

Route::add('/api/updateUserRole', function(){
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'PUT'){
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id']) && isset($data['role'])) {
            try {
                $role = UserRole::from($data['role']);
                $updated = $userController->updateUserRole($data['id'], $role);
                echo json_encode(["success" => $updated]);
            } catch (ValueError $e) {
                echo json_encode(["error" => "Invalid role"]);
            }
        } else {
            echo json_encode(["error" => "User ID and new role are required"]);
        }
    }
}, 'put');

Route::add('/api/updateUserEmail', function(){
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'PUT'){
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id']) && isset($data['email'])) {
            $updated = $userController->updateUserEmail($data['id'], $data['email']);
            echo json_encode(["success" => $updated]);
        } else {
            echo json_encode(["error" => "User ID and new email are required"]);
        }
    }
}, 'put');

Route::add('/api/createUser', function() {
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['email'], $data['password'], $data['role'])) {
            try {
                $role = UserRole::from($data['role']); 
                $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
                $userController->createUser($data['email'], $hashedPassword, $role);
                
                echo json_encode(["success" => true]);
            } catch (UnexpectedValueException $e) {
                echo json_encode(["error" => "Invalid role"]);
            }
        } else {
            echo json_encode(["error" => "Missing required fields"]);
        }
    }
}, 'post');

Route::add('/api/getUserEmailById', function(){
    $userController = new UserController();
    $user = $userController->getUserInfoById(); 

    echo json_encode([
        "email" => $user["email"],
        "name" => $user["name"]
    ]);
});

Route::add('/api/updateUserProfile', function () {
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents("php://input"), true);

        $updates = [];

        if (!empty($data['email'])) {
            $updates['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($updates['email'], FILTER_VALIDATE_EMAIL)) {
                error_log("Invalid email format: " . $updates['email']);
                echo json_encode(["error" => "Invalid email format"]);
                return;
            }
        }
        
        if (!empty($data['name'])) {
            $updates['name'] = htmlspecialchars(trim($data['name']));
        }

        if (!empty($data['password'])) {
            $updates['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        if (empty($updates)) {
            error_log("No fields to update.");
            echo json_encode(["error" => "No fields to update"]);
            return;
        }

        $updated = $userController->updateUserProfile($updates);
        error_log("Update result: " . json_encode($updated));

        echo json_encode(["success" => $updated]);
    }
}, 'put');