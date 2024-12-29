<?php
// dd($_SESSION);
if (!User::isLoggedIn()) header('Location: /login');

require "views/home.view.php";
require "controllers/task/add.php";
require "controllers/task/edit.php";
require "views/components/addTeamForm.php";
