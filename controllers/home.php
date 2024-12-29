<?php
    if (!User::isLoggedIn()) header('Location: /login');
    $user_id=$_SESSION['id'];
    $group_id=$_SESSION['id_group'];
    $admin_id=$_SESSION['id_admin'];
    require_once 'models/model.php';
    require_once 'config/database.php';
    ob_start(); 
    require "views/home.view.php";
    require "views/components/addTaskForm.php";
    require "views/components/addTeamForm.php";
    require "views/components/addmember.php";
    require "views/components/members.php";
    echo $user_id;
    echo "\n";
    echo $group_id;
    echo "\n";
    echo $admin_id;
