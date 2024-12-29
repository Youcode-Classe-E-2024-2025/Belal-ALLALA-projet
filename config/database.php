<?php
$sql_file_path = 'config/data.sql';
try {
    $db = new Database();
} catch (PDOException $e) {
    try {
        $db_create = new database('localhost', '', 'root', '');
        $sql = file_get_contents($sql_file_path);
        // dd($sql);
        if ($sql === false) {
            die("Erreur: Impossible de lire le fichier SQL: " . $sql_file_path);
        }
        $db_create->query($sql);
        $db = new database();
    } catch (PDOException $ex) {
        die("Erreur lors de la création de la base de données : " . $ex->getMessage());
    }
}
