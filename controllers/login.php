<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);
   $db = new Database();
   $result = User::login($db, $email, $password);

   if (!$result['success']) {
      $error = $result['message'];
      // dd($error);
   } else {

      // obtenir id de base de donnes
      $_SESSION['id'] = $result['id'];
      // dd($_SESSION);
      header('Location: /home');
   }
}

require "views/login.view.php";
