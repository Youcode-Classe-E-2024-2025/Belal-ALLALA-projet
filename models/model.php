<?php
class Database
{
    public $connection;

    public function __construct($host = 'localhost', $dbname = 'TaskFlow', $username = 'root', $password = '')
    {
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => true
        ]);
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}

class Validator
{

    public static function notEmpty($value)
    {
        return !empty(trim($value));
    }

    public static function minLength($value, $min)
    {
        return strlen($value) >= $min;
    }

    public static function maxLength($value, $max)
    {
        return strlen($value) <= $max;
    }

    public static function fullname($fullname)
    {
        // Regex pour valider "nom prenom" en majuscules ou minuscules
        $regex = "/^[a-zA-Z]+ [a-zA-Z]+$/";
        return preg_match($regex, $fullname) === 1;
    }

    public static function email($value)
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $value) === 1;
    }

    public static function strongPassword($value)
    {
        // Vérifie au moins une lettre, un chiffre et une longueur de 8 caractères
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $value) === 1;
    }

    public static function regex($value, $pattern)
    {
        return preg_match($pattern, $value);
    }

    public static function matches($value, $comparisonValue)
    {
        return $value === $comparisonValue;
    }
}


class User
{
    private $db;
    private $id;
    private $name;
    private $email;
    private $password;
    private $confirmPassword;

    public function __construct($name, $email, $password, $confirmPassword)
    {
        $this->db = new Database();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function createUser()
    {

        if (!Validator::fullname($this->name)) {
            return [
                'success' => false,
                'message' => 'invalid name value.'
            ];
        }

        if (!Validator::email($this->email)) {
            return [
                'success' => false,
                'message' => 'Invalid email address.'
            ];
        }

        if (!Validator::strongPassword($this->password)) {
            return [
                'success' => false,
                'message' => 'Invalid password.'
            ];
        }

        if (!Validator::matches($this->password, $this->confirmPassword)) {
            return [
                'success' => false,
                'message' => 'Passwords are not identical.'
            ];
        }

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        if ($this->emailExists()) {
            return [
                'success' => false,
                'message' => 'L\'email existe déjà.'
            ];
        }

        $sql = "INSERT INTO users (name, email, password_hash,created_at) VALUES (?,?,?,NOW())";
        $params = [
            $this->name,
            $this->email,
            $hashedPassword
        ];

        $stmt = $this->db->query($sql, $params);

        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Utilisateur créé avec succès.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Erreur lors de la création de l\'utilisateur.'
        ];
    }


    public function getUserById()
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $params = [$this->id];
        $stmt = $this->db->query($sql, $params);

        $user = $stmt->fetch();
        if ($user) {
            $this->name = $user['name'];
            $this->email = $user['email'];
            return [
                'success' => true,
                'user' => $user,
                'message' => 'Utilisateur trouvé.'
            ];
        }
        return [
            'success' => false,
            'user' => null,
            'message' => 'Utilisateur non trouvé.'
        ];
    }

    public function updateUser()
    {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = ?, email = ?, password_hash=? WHERE id = ?";
        $params = [
            $this->name,
            $this->email,
            $hashedPassword,
            $this->id,
        ];

        $stmt = $this->db->query($sql, $params);

        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Utilisateur mis à jour avec succès.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Erreur lors de la mise à jour de l\'utilisateur.'
        ];
    }

    public function deleteUser()
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $params = [$this->id];

        $stmt = $this->db->query($sql, $params);

        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Erreur lors de la suppression de l\'utilisateur.'
        ];
    }

    public function emailExists()
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $params = [$this->email];

        $stmt = $this->db->query($sql, $params);

        return $stmt->fetchColumn() > 0;
    }

    public static function checkPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    public static function login($db, $email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $params = [$email];
        $stmt = $db->query($sql, $params);
        $user = $stmt->fetch();
        if ($user) {
            if (self::checkPassword($password, $user['password_hash'])) {
                return [
                    'success' => true,
                    'message' => 'Connexion réussie.',
                    'id' => $user['id']
                ];
            }
            return [
                'success' => false,
                'message' => 'Email ou mot de passe incorrect.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Email non trouvé.'
        ];
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    public static function isPersonal()
    {
        return !isset($_SESSION['team_id']);
    }
}


class Team
{
    private $id;
    private $name;
    private $adminId;
    private $db;

    public function __construct($id, $name, $adminId, $db)
    {
        $this->id = $id;
        $this->name = $name;
        $this->adminId = $adminId;
        $this->db = $db;
        $this->createTeam();
    }

    public function createTeam()
    {
        $sql = "INSERT INTO teams (name, id_admin) VALUES (?, ?)";
        $params = [$this->name, $this->adminId];
        $stmt = $this->db->query($sql, $params);
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Équipe créée avec succès.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Erreur lors de la création de l\'équipe.'
        ];
    }

    public function updateTeam()
    {
        $sql = "UPDATE teams SET name = ?, id_admin = ? WHERE id = ?";
        $params = [$this->name, $this->adminId, $this->id];
        $stmt = $this->db->query($sql, $params);
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Équipe mise à jour avec succès.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Erreur lors de la mise à jour de l\'équipe.'
        ];
    }

    public function deleteTeam()
    {
        $sql = "DELETE FROM teams WHERE id = ?";
        $params = [$this->id];
        $stmt = $this->db->query($sql, $params);
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Équipe supprimée avec succès.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Erreur lors de la suppression de l\'équipe.'
        ];
    }

    public function getTeamById()
    {
        $sql = "SELECT * FROM teams WHERE id = ?";
        $params = [$this->id];
        $stmt = $this->db->query($sql, $params);
        $team = $stmt->fetch();
        if ($team) {
            $this->name = $team['name'];
            $this->adminId = $team['id_admin'];
            return [
                'success' => true,
                'data' => $team,
                'message' => 'Équipe trouvée.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Équipe non trouvée.'
        ];
    }

    public function getAllTeams()
    {
        $sql = "SELECT * FROM teams";
        $stmt = $this->db->query($sql);
        $teams = $stmt->fetchAll();
        if ($teams) {
            return [
                'success' => true,
                'data' => $teams,
                'message' => count($teams) . ' équipes trouvées.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Aucune équipe trouvée.'
        ];
    }
}


class Task
{
    private $id;
    private $titre;
    private $description;
    private $deadline;
    private $statut;
    private $type;
    private $idGroup;
    private $updatedAt;
    private $db;

    public function __construct($titre, $description, $deadline, $statut, $type, $id = null, $idGroup = null)
    {
        $this->db = new Database();
        $this->titre = $titre;
        $this->description = $description;
        $this->deadline = $deadline;
        $this->statut = $statut;
        $this->type = $type;
        $this->id = $id;
        $this->idGroup = $idGroup;
    }

    public function create()
    {
        $sql = "INSERT INTO tasks (titre, description, deadline, statut, type, id_group, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $params = [
            $this->titre,
            $this->description,
            $this->deadline,
            $this->statut,
            $this->type,
            $this->idGroup
        ];
        try {
            $stmt = $this->db->query($sql, $params);

            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Tâche créée avec succès.',
                    'id' => $this->db->connection->lastInsertId()
                ];
            }
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Erreur lors de la création de la tâche.'
            ];
        }
    }

    public static function getTask($id)
    {
        $db = (new Database())->connection;

        // Vérification de la connexion
        if (!$db) {
            die("Database connection not established.");
        }

        $query = "SELECT * FROM tasks WHERE id = ?";
        $params = [$id];

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);

            $task = $stmt->fetch();

            if ($task === false) {
                echo "No user found with ID $id.";
            } else {
                return $task; // Affiche les données utilisateur
            }
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    public function update()
    {
        $sql = "UPDATE tasks SET titre = ?, description = ?, deadline = ?, statut = ?, type = ?, updated_at = NOW() 
                WHERE id = ?";
        $params = [
            $this->titre,
            $this->description,
            $this->deadline,
            $this->statut,
            $this->type,
            $this->id,
        ];
        try {
            $stmt = $this->db->connection->prepare($sql);
            $stmt->execute($params);

            // Vérifie le nombre de lignes affectées
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Tâche mise à jour avec succès.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Aucune modification effectuée ou erreur lors de la mise à jour.'
                ];
            }
        } catch (\Throwable $th) {
            // Gère les erreurs
            return [
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la tâche : ' . $th->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM task WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Tâche supprimée avec succès.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Erreur lors de la suppression de la tâche.'
        ];
    }

    public function assignUser($id_task, $id_user)
    {
        $sql = "INSERT INTO task_user (id_task, id_user, assigned_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->query($sql, [$id_task, $id_user]);
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Utilisateur assigné à la tâche avec succès.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Erreur lors de l\'assignation de l\'utilisateur.'
        ];
    }

    public function unassignUser($id_task, $id_user)
    {
        $sql = "DELETE FROM task_user WHERE id_task = ? AND id_user = ?";
        $stmt = $this->db->query($sql, [$id_task, $id_user]);
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => 'Utilisateur désassigné de la tâche avec succès.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Erreur lors de la désassignation de l\'utilisateur.'
        ];
    }

    public function getAssignedUsers($id_task)
    {
        $sql = "SELECT u.id, u.name, u.email FROM users u 
                    INNER JOIN task_user tu ON u.id = tu.id_user 
                    WHERE tu.id_task = ?";
        $stmt = $this->db->query($sql, [$id_task]);
        $users = $stmt->fetchAll();
        if (!empty($users)) {
            return [
                'success' => true,
                'data' => $users,
                'message' => 'Utilisateurs assignés récupérés avec succès.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Aucun utilisateur assigné trouvé pour cette tâche.'
        ];
    }
}


class TeamMember
{
    private $db;
    private $id;
    private $id_group;
    private $id_user;
    private $joined_at;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($id_group, $id_user)
    {
        if ($this->isTeamMember($id_group, $id_user)) {
            return [
                'success' => false,
                'message' => 'Le membre fait déjà partie de l\'équipe.'
            ];
        }

        $sql = "INSERT INTO team_member (id_group, id_user, joined_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->query($sql, [$id_group, $id_user]);

        return $this->checkResult($stmt, 'Membre ajouté à l\'équipe avec succès.');
    }

    public function remove($id_group, $id_user)
    {
        $sql = "DELETE FROM team_member WHERE id_group = ? AND id_user = ?";
        $stmt = $this->db->query($sql, [$id_group, $id_user]);

        return $this->checkResult($stmt, 'Membre retiré de l\'équipe avec succès.');
    }

    public function getByTeam($id_group)
    {
        $sql = "SELECT u.id, u.name, u.email 
                    FROM users u
                    INNER JOIN team_member tm ON u.id = tm.id_user
                    WHERE tm.id_group = ?";
        $stmt = $this->db->query($sql, [$id_group]);
        $members = $stmt->fetchAll();

        if (!empty($members)) {
            return [
                'success' => true,
                'data' => $members,
                'message' => 'Membres de l\'équipe récupérés avec succès.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Aucun membre trouvé pour cette équipe.'
        ];
    }

    public function isTeamMember($id_group, $id_user)
    {
        $sql = "SELECT * FROM team_member WHERE id_group = ? AND id_user = ?";
        $stmt = $this->db->query($sql, [$id_group, $id_user]);
        return $stmt->rowCount() > 0;
    }


    public function getTeamsByUser($id_user)
    {
        $sql = "SELECT t.id, t.name
                    FROM teams t
                    INNER JOIN team_member tm ON t.id = tm.id_group
                    WHERE tm.id_user = ?";
        $stmt = $this->db->query($sql, [$id_user]);
        return $stmt->fetchAll();
    }


    private function checkResult($stmt, $successMessage)
    {
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => $successMessage
            ];
        }

        return [
            'success' => false,
            'message' => 'Erreur lors de l\'opération sur le membre de l\'équipe.'
        ];
    }
}



class TaskUser
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function assign($id_task, $id_user)
    {
        if ($this->isAssigned($id_task, $id_user)) {
            return [
                'success' => false,
                'message' => 'L\'utilisateur est déjà assigné à cette tâche.'
            ];
        }

        $sql = "INSERT INTO task_user (id_task, id_user, assigned_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->query($sql, [$id_task, $id_user]);

        return $this->checkResult($stmt, 'Utilisateur assigné à la tâche avec succès.');
    }

    public function unassign($id_task, $id_user)
    {
        $sql = "DELETE FROM task_user WHERE id_task = ? AND id_user = ?";
        $stmt = $this->db->query($sql, [$id_task, $id_user]);

        return $this->checkResult($stmt, 'Utilisateur désassigné de la tâche avec succès.');
    }

    public function isAssigned($id_task, $id_user)
    {
        $sql = "SELECT * FROM task_user WHERE id_task = ? AND id_user = ?";
        $stmt = $this->db->query($sql, [$id_task, $id_user]);
        return $stmt->rowCount() > 0;
    }

    public function getUsersByTask($id_task)
    {
        $sql = "SELECT u.id, u.name, u.email
                    FROM users u
                    INNER JOIN task_user tu ON u.id = tu.id_user
                    WHERE tu.id_task = ?";
        $stmt = $this->db->query($sql, [$id_task]);
        return $stmt->fetchAll();
    }

    public function getTasksByUser($id_user)
    {
        $sql = "SELECT t.id, t.titre, t.description, t.id_group
                    FROM tasks t
                    INNER JOIN task_user tu ON t.id = tu.id_task
                    WHERE tu.id_user = ?";
        $stmt = $this->db->query($sql, [$id_user]);
        return $stmt->fetchAll();
    }

    private function checkResult($stmt, $successMessage)
    {
        if ($stmt->rowCount() > 0) {
            return [
                'success' => true,
                'message' => $successMessage
            ];
        }
        return [
            'success' => false,
            'message' => 'Erreur lors de l\'opération sur l\'assignation de la tâche.'
        ];
    }

    public function unassignAll($id_task)
    {
        $sql = "DELETE FROM task_user WHERE id_task = ?";
        $stmt = $this->db->query($sql, [$id_task]);
        return $this->checkResult($stmt, 'Toutes les assignations pour cette tâche ont été supprimées avec succès.');
    }
}
