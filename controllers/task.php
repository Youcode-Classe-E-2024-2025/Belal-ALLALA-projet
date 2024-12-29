<?php

    $id = $user_id;
    $taskUser = new TaskUser($db);
    if ($admin_id===$user_id){
        $response = Task::getTasksByGroupId($group_id, $db);
        if ($response['success'] && isset($response['data'])) {
            $allTasks = $response['data'];
        } else {
            $allTasks =[];
        }
    }else if ($group_id !== NULL){
        $allTasks=Task::getTasksAssignedToUserInGroup($user_id, $group_id, $db);
    }else{
        $allTasks=Task::getTasksWithoutGroupAssignedToUser($user_id, $db);
    } 
    $todoTasks = [];
    $doneTasks = [];
    $doingTasks = [];
    // print_r($allTasks);

    if ($allTasks) {
        foreach ($allTasks as $task) {
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

?>