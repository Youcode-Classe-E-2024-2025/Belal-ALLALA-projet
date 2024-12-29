<?php
    if (!User::isLoggedIn()) header('Location: /login');
    $user_id=$_SESSION['id'];
    $group_id=$_SESSION['id_group'];
    $admin_id=$_SESSION['id_admin'];
    require "views/home.view.php";
    require "views/components/addTaskForm.php";
    require "views/components/editTaskForm.php";
    require "views/components/addTeamForm.php";
