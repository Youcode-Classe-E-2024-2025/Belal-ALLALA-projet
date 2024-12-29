<?php
   if (isset($_POST['addTask'])) {
      $title = htmlspecialchars($_POST['title']);
      $description = htmlspecialchars($_POST['description']);
      $date = htmlspecialchars($_POST['date']);
      $time = htmlspecialchars($_POST['time']);
      $deadline = $date . ' ' . $time;
      $status = htmlspecialchars($_POST['statut']);
      $type = htmlspecialchars($_POST['type']); 
      $newTask = new Task($title, $description, $deadline, $status, $type, $group_id);
      $result = $newTask->create();
      if ($result['success']){
         if(isset($_POST['assignedTo'])){
            $assignedTo =$_POST['assignedTo'];
            $newTask->assignUser($result['id'], $assignedTo);
         } else {
            $newTask->assignUser($result['id'], $user_id);
         }
         header('Location: /');   
      }
   }
?>
