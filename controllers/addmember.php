<?php 
    if(isset($_POST['ajouterMember'])){
        $id_member=$_POST['selectedMember'];
        if (!empty($id_member)) {
            $teamMember = new TeamMember($db);
            $addMember = $teamMember->add($group_id, $id_member);  
            if ($addMember['success']) {
                echo "<p style='color: green;'>{$addMember['message']}</p>";
            } else {
                echo "<p style='color: red;'>{$addMember['message']}</p>";
            }
        }else {
            echo "<p style='color: red;'>Veuillez remplir tous les champs.</p>";
        } 
    }
?>