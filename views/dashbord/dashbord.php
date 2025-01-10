<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Rôle</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php  
    require_once '../../models/model.php';
    require_once '../../models/roles.php';
    require_once '../../config/database.php';
    $role = new Role($db);
    $permission = new Permission($db);
    $rolePermission = new RolePermission($db);
    $allRoles = $role->getAll();
    if($allRoles['success']){
	    $roles = $allRoles['data'];
    }else{
	    $roles = [];
    }
?>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des Rôles</h2>
            <a href="ajouter_role.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Ajouter un Rôle
            </a>
        </div>

        <?php if (empty($roles)): ?>
            <p class="text-gray-600 text-center">Aucun rôle trouvé.</p>
        <?php else: ?>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 font-semibold text-left">Nom</th>
                        <th class="py-3 px-4 font-semibold text-left">Description</th>
                        <th class="py-3 px-4 font-semibold text-left">Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $roleItem): 
                        $rolePermissions = $rolePermission->getPermissionsByRole($roleItem['id']);
                        if (!empty($rolePermissions)) {
                            $permissions = $rolePermissions;
                        }else{
                            $permissions = [];
                        }
                    ?>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4"><?php echo htmlspecialchars($roleItem['name']); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($roleItem['description']); ?></td>
                        <td class="py-3 px-4">
                            <?php if (!empty($permissions)): ?>
                                <ul class="list-disc list-inside">
                                    <?php foreach ($permissions as $permission): ?>
                                        <li><?php echo htmlspecialchars($permission['name']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <span class="text-gray-500">Aucune permission</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
            <?php endif; ?>
        </div>
</body>
</html>