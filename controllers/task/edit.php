<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
   $title = htmlspecialchars($_POST['title']);
   $description = htmlspecialchars($_POST['description']);
   $date = htmlspecialchars($_POST['date']);
   $time = htmlspecialchars($_POST['time']);
   $deadline = $date . ' ' . $time;
   $status = htmlspecialchars($_POST['statut']);
   $type = htmlspecialchars($_POST['type']);
   $id = (int) htmlspecialchars($_POST['id']);
   $newTask = new Task($title, $description, $deadline, $status, $type, $id);
   $result = $newTask->update();
   if (!$result['success']) $error =  $result['message'];
}



require 'views/components/editTaskForm.php';
