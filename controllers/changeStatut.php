<?php 
    require_once  '../models/model.php';
    require_once '../config/database.php';
    $id_task = $_GET['id'];
    $task=Task::toggleStatus($task_id, $db);
    header('location: /');
?>