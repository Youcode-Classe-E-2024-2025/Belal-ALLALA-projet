<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
   $title = htmlspecialchars($_POST['title']);
   $description = htmlspecialchars($_POST['description']);
   $date = htmlspecialchars($_POST['date']);
   $time = htmlspecialchars($_POST['time']);
   $deadline = $date . ' ' . $time;
   $status = htmlspecialchars($_POST['statut']);
   $type = htmlspecialchars($_POST['type']);
   // dd($deadline);
   // $id_group = $_POST['id_group'];
   // $assignedTo  
   $newTask = new Task($title, $description, $deadline, $status, $type);
   $result = $newTask->create();

   if (!$result['success']) $error = $result['message'];
}

require 'views/components/addTaskForm.php';
