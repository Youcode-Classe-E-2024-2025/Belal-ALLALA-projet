<?php
    require_once 'models/model.php';
    require_once 'config/database.php';

    $id = 2;
    $taskUser = new TaskUser($db);
    $allTasks = $taskUser->getTasksByUser($id); 

    $personalTasks = []; 
    $todoTasks = [];
    $doneTasks = [];
    $doingTasks = [];


    if ($allTasks) {
        foreach ($allTasks as $task) {
            if ($task['id_group'] === null) { 
                $personalTasks[] = $task;
                switch ($task['statut']) { 
                    case 'Todo':
                        $todoTasks[] = $task;
                        break;
                    case 'Done':
                        $doneTasks[] = $task;
                        break;
                    case 'Doing':
                        $doingTasks[] = $task;
                        break;
                }
            }
        }
    }

?>