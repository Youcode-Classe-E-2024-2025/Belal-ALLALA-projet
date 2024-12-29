<?php

    $id = $user_id;
    $taskUser = new TaskUser($db);
    $allTasks = $taskUser->getTasksByUser($id); 

    $Tasks = []; 
    $todoTasks = [];
    $doneTasks = [];
    $doingTasks = [];


    if ($allTasks) {
        foreach ($allTasks as $task) {
            if ($task['id_group'] === $group_id) { 
                $Tasks[] = $task;
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