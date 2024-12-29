<?php 
    if(isset($_POST['ajouterteam'])){
        $name=$_POST['name'];
        if (!empty($name)) {
            $team = new Team(null, $name, $user_id, $db);
            $result = $team->createTeam();
            if ($result['success']) {
                $_SESSION['id_group'] = $result['teamId'];
                $_SESSION['id_admin'] = $user_id;
                $teamMember = new TeamMember($db);
                $addResult = $teamMember->add($result['teamId'], $user_id); 
                if ($addResult['success']) {
                    echo "<p style='color: green;'>{$result['message']}</p>";
                    header('Location: /');
                    exit;
                } else {
                        echo "<p style='color: red;'>{$result['message']}</p>";
                }
            } else {
                echo "<p style='color: red;'>{$result['message']}</p>";
            }
        }else {
            echo "<p style='color: red;'>Veuillez remplir tous les champs.</p>";
        } 
    }
    ?>