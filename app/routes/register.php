<?php

require_once(__DIR__ . '/../src/controllers/UserController.php');

Route::add('/register', function () {
    require_once(__DIR__ . "/../views/pages/register.php");
});

Route::add('/register', function () {
    // Sanitize input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));
    $recaptchaToken = $_POST['g-recaptcha-response'];
    $name = htmlspecialchars(trim($_POST['name']));

    $userController = new UserController();
    $userController->registerUser($email, $password, $recaptchaToken, $name);
}, "post");