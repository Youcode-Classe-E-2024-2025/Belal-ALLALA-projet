<?php
require "../../models/model.php";
if (isset($_GET['action']) && $_GET['action'] === 'getUser') {
   $id = (int) $_GET['id'];
   echo json_encode(Task::getTask($id));
   exit;
}
