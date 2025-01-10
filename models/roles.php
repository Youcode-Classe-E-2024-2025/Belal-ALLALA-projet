<?php

    class Role
    {
        private $db;
        private $id;
        private $name;
        private $description;

        public function __construct(Database $db)
        {
            $this->db = $db;
        }


        public function create($name, $description = null)
        {
            if ($this->getByName($name)['success']) {
                return [
                    'success' => false,
                    'message' => 'Un rôle avec ce nom existe déjà.'
                ];
            }

            $sql = "INSERT INTO roles (name, description,created_at) VALUES (?,?,NOW())";
            $stmt = $this->db->query($sql, [$name, $description]);
            return $this->checkResult($stmt, 'Rôle créé avec succès.',true);
        }


        public function getByName($name)
        {
            $sql = "SELECT * FROM roles WHERE name = ?";
            $stmt = $this->db->query($sql, [$name]);
            $role = $stmt->fetch();

            if ($role) {
                return [
                    'success' => true,
                    'data' => $role,
                    'message' => 'Rôle trouvé.'
                ];
            }

            return [
                'success' => false,
                'message' => 'Rôle non trouvé.'
            ];
        }


        public function update($id, $name, $description = null)
        {
            $sql = "UPDATE roles SET name = ?, description = ? WHERE id = ?";
            $stmt = $this->db->query($sql, [$name, $description, $id]);
            return $this->checkResult($stmt, 'Rôle mis à jour avec succès.');
        }

        public function delete($id)
        {
            $sql = "DELETE FROM roles WHERE id = ?";
            $stmt = $this->db->query($sql, [$id]);
        return $this->checkResult($stmt, 'Rôle supprimé avec succès.');
        }

        public function getAll()
        {
            $sql = "SELECT * FROM roles";
            $stmt = $this->db->query($sql);
            $roles = $stmt->fetchAll();

            if (!empty($roles)) {
                return [
                    'success' => true,
                    'data' => $roles,
                    'message' => 'Rôles récupérés avec succès.'
                ];
            }
            return [
                'success' => false,
                'message' => 'Aucun rôle trouvé.'
            ];
        }

        private function checkResult($stmt, $successMessage,$isCreated=false)
        {
            if ($stmt->rowCount() > 0) {
                $data=[
                    'success' => true,
                    'message' => $successMessage,
                ];
                if($isCreated){
                    $data['id'] = $this->db->getLastInsertId();
                }
                return $data;
            }

            return [
                'success' => false,
                'message' => 'Erreur lors de l\'opération.'
            ];
        }
    }

    class Permission
    {
        private $db;
        private $id;
        private $name;
        private $description;

        public function __construct(Database $db)
        {
            $this->db = $db;
        }


        public function create($name, $description = null)
        {
            if ($this->getByName($name)['success']) {
                return [
                    'success' => false,
                    'message' => 'Une permission avec ce nom existe déjà.'
                ];
            }
            $sql = "INSERT INTO permissions (name, description,created_at) VALUES (?,?,NOW())";
            $stmt = $this->db->query($sql, [$name, $description]);
        return $this->checkResult($stmt, 'Permission créée avec succès.',true);
        }


        public function getByName($name)
        {
            $sql = "SELECT * FROM permissions WHERE name = ?";
            $stmt = $this->db->query($sql, [$name]);
            $permission = $stmt->fetch();

            if ($permission) {
                return [
                    'success' => true,
                    'data' => $permission,
                    'message' => 'Permission trouvée.'
                ];
            }

            return [
                'success' => false,
                'message' => 'Permission non trouvée.'
            ];
        }


        public function update($id, $name, $description = null)
        {
            $sql = "UPDATE permissions SET name = ?, description = ? WHERE id = ?";
            $stmt = $this->db->query($sql, [$name, $description, $id]);
            return $this->checkResult($stmt, 'Permission mise à jour avec succès.');

        }

        public function delete($id)
        {
            $sql = "DELETE FROM permissions WHERE id = ?";
            $stmt = $this->db->query($sql, [$id]);
            return $this->checkResult($stmt, 'Permission supprimée avec succès.');

        }

        public function getAll()
        {
            $sql = "SELECT * FROM permissions";
            $stmt = $this->db->query($sql);
            $permissions = $stmt->fetchAll();
            if (!empty($permissions)) {
                return [
                    'success' => true,
                    'data' => $permissions,
                    'message' => 'Permissions récupérées avec succès.'
                ];
            }
            return [
                'success' => false,
                'message' => 'Aucune permission trouvée.'
            ];
        }

        private function checkResult($stmt, $successMessage,$isCreated=false)
        {
            if ($stmt->rowCount() > 0) {
                $data=[
                    'success' => true,
                    'message' => $successMessage,
                ];
                if($isCreated){
                    $data['id'] = $this->db->getLastInsertId();
                }
                return $data;
            }

            return [
                'success' => false,
                'message' => 'Erreur lors de l\'opération.'
            ];
        }
    }

    class RolePermission
    {
        private $db;

        public function __construct(Database $db)
        {
            $this->db = $db;
        }


        public function add($roleId, $permissionId)
        {
            if ($this->exists($roleId, $permissionId)) {
                return [
                    'success' => false,
                    'message' => 'Cette permission est déjà associée à ce rôle.'
                ];
            }
            $sql = "INSERT INTO role_permission (role_id, permission_id, assigned_at) VALUES (?, ?, NOW())";
            $stmt = $this->db->query($sql, [$roleId, $permissionId]);
            return $this->checkResult($stmt, 'Permission ajoutée au rôle avec succès.');
        }


        public function remove($roleId, $permissionId)
        {
            $sql = "DELETE FROM role_permission WHERE role_id = ? AND permission_id = ?";
            $stmt = $this->db->query($sql, [$roleId, $permissionId]);
            return $this->checkResult($stmt, 'Permission retirée du rôle avec succès.');
        }


        public function exists($roleId, $permissionId)
        {
            $sql = "SELECT * FROM role_permission WHERE role_id = ? AND permission_id = ?";
            $stmt = $this->db->query($sql, [$roleId, $permissionId]);
            return $stmt->rowCount() > 0;
        }


        public function getPermissionsByRole($roleId)
        {
            $sql = "SELECT p.id, p.name, p.description
                    FROM permissions p
                    INNER JOIN role_permission rp ON p.id = rp.permission_id
                    WHERE rp.role_id = ?";
            $stmt = $this->db->query($sql, [$roleId]);
            return $stmt->fetchAll();
        }


        public function getRolesByPermission($permissionId)
        {
            $sql = "SELECT r.id, r.name, r.description
                    FROM roles r
                    INNER JOIN role_permission rp ON r.id = rp.role_id
                    WHERE rp.permission_id = ?";
            $stmt = $this->db->query($sql, [$permissionId]);
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
                'message' => 'Erreur lors de l\'opération.'
            ];
        }
    }

    class ProjectUserRoles
    {
        private $db;

        public function __construct(Database $db)
        {
            $this->db = $db;
        }


        public function add($userId, $teamId, $roleId)
        {
            if ($this->exists($userId, $teamId, $roleId)) {
                return [
                    'success' => false,
                    'message' => 'Cet utilisateur a déjà ce rôle dans cette équipe.'
                ];
            }
            $sql = "INSERT INTO project_user_roles (user_id, team_id, role_id, assigned_at) VALUES (?, ?, ?, NOW())";
            $stmt = $this->db->query($sql, [$userId, $teamId, $roleId]);
            return $this->checkResult($stmt, 'Rôle attribué à l\'utilisateur dans l\'équipe avec succès.');

        }

        public function update($userId, $teamId, $roleId)
        {
        $sql = "UPDATE project_user_roles SET role_id = ? WHERE user_id = ? AND team_id = ?";
        $stmt = $this->db->query($sql, [$roleId, $userId, $teamId]);
        return $this->checkResult($stmt, 'Rôle de l\'utilisateur mis à jour dans l\'équipe avec succès.');
        }

        public function remove($userId, $teamId, $roleId)
        {
            $sql = "DELETE FROM project_user_roles WHERE user_id = ? AND team_id = ? AND role_id = ?";
            $stmt = $this->db->query($sql, [$userId, $teamId, $roleId]);
            return $this->checkResult($stmt, 'Rôle retiré de l\'utilisateur dans l\'équipe avec succès.');
        }

        public function exists($userId, $teamId, $roleId)
        {
            $sql = "SELECT * FROM project_user_roles WHERE user_id = ? AND team_id = ? AND role_id = ?";
            $stmt = $this->db->query($sql, [$userId, $teamId, $roleId]);
            return $stmt->rowCount() > 0;
        }

        public function getRolesByUserInTeam($userId, $teamId)
        {
            $sql = "SELECT r.id, r.name, r.description
                    FROM roles r
                    INNER JOIN project_user_roles pur ON r.id = pur.role_id
                    WHERE pur.user_id = ? AND pur.team_id = ?";
            $stmt = $this->db->query($sql, [$userId, $teamId]);
            return $stmt->fetchAll();
        }


        public function getUsersByRoleInTeam($roleId, $teamId)
        {
            $sql = "SELECT u.id, u.name, u.email
                    FROM users u
                    INNER JOIN project_user_roles pur ON u.id = pur.user_id
                    WHERE pur.role_id = ? AND pur.team_id = ?";
            $stmt = $this->db->query($sql, [$roleId, $teamId]);
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
                'message' => 'Erreur lors de l\'opération.'
            ];
        }
    }

?>