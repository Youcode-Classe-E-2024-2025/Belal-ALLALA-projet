<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);
   $db = new Database();
   $result = User::login($db, $email, $password);

   if (!$result['success']) {
      $error = $result['message'];
   } else {
      $_SESSION['id'] = $result['id'];
      $_SESSION['id_group'] = NULL;
      $_SESSION['id_admin'] = NULL;
      header('Location: /home');
   }
}

require "views/login.view.php";
