<?php 
    if (isset($_POST['selectedTeam'])) {
        $id_group = $_POST['selectedTeam'] !== '' ? (int) $_POST['selectedTeam'] : null;
        $_SESSION['id'] = $user_id;
        $_SESSION['id_group'] = $id_group;
        if ($id_group === null) {
            $_SESSION['id_admin'] = null;
        } else { 
            $result = Team::getTeamById($id_group,$db);
    
            if ($result && $result['data']['id_admin'] === $user_id) {
                $_SESSION['id_admin'] = $user_id;
            } else {
                $_SESSION['id_admin'] = null;
            }
        }
        header('Location: /');
        exit;
    }
    ?>