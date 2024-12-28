<?php 
    require_once  '../models/model.php';
    require_once '../config/database.php';
    $id_task = $_GET['id'];
    $taskUser = new TaskUser($db);
    $task = new Task($db);
    $taskUser->unassignAll($id_task);
    $task->delete($id_task);
    header('location: /');
?>