<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $fullname = htmlspecialchars($_POST['fullname']);
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);
   $confirmPassword = htmlspecialchars($_POST['confirm-password']);

   $newUser = new User($fullname, $email, $password, $confirmPassword);

   $result = $newUser->createUser();

   if (!$result['success']) {
      $error = $result['message'];
      // dd($error);
   } else header('Location: /login');
}

require "views/signup.view.php";
