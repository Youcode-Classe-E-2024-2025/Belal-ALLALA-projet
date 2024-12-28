<?php
// dd($_SESSION);
if (!User::isLoggedIn()) header('Location: /login');

require "views/home.view.php";
require "views/components/addTaskForm.php";
require "views/components/editTaskForm.php";
require "views/components/addTeamForm.php";
