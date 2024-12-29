<?php 
   if(isset($_POST['ajouter'])){
      $name=$_POST['name'];

      if (!empty($name)) {
         try {
            $team = new Team(null, $name, $user_id, $db);
            $result = $team->createTeam();
            if ($result['success']) {
                $_SESSION['id_group'] = $result['teamId'];
                $_SESSION['id_admin'] = $user_id;
                header('location: /');
               echo "<p style='color: green;'>{$result['message']}</p>";
            } else {
                 echo "<p style='color: red;'>{$result['message']}</p>";
            }
         } catch (Exception $e) {
             echo "<p style='color: red;'>Erreur: {$e->getMessage()}</p>";
         }
      } else {
         echo "<p style='color: red;'>Veuillez remplir tous les champs.</p>";
      } 
   } ?>