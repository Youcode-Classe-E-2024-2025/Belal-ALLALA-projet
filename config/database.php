<?php

$dsn = 'mysql:host=localhost;dbname=TaskFlow';
$user = 'root';
$pass = '';
$sql_file_path = 'data.sql'; 

try {
    $pdo = new PDO($dsn, $user, $pass); 
} catch (PDOException $e) {
    echo "Connexion à la base de données échouée : " . $e->getMessage() . "\n";

    try {
        $pdo_create = new PDO('mysql:host=localhost', $user, $pass); 
        $sql = file_get_contents($sql_file_path);
        if ($sql === false) {
            die("Erreur: Impossible de lire le fichier SQL: " . $sql_file_path);
        }
        $result = $pdo_create->exec($sql);
        if ($result === false) {
            die ("Erreur lors de l'exécution du script SQL : ".implode(":",$pdo_create->errorInfo()));
        }
        echo "Base de données 'TaskFlow' créée avec succès.\n";

        // Reconnexion 
        $pdo = new PDO($dsn, $user, $pass);
        echo "Connexion à la base de données 'TaskFlow' réussie.\n";
    } catch (PDOException $ex) {
        die("Erreur lors de la création de la base de données : " . $ex->getMessage());
    }
}
?>