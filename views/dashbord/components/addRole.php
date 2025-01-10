<div class="container mx-auto py-8">
    <form action="ajouter_role.php" method="post" class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Ajouter un Rôle</h2>

        <div class="mb-4">
            <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">Nom du Rôle:</label>
            <input type="text" name="role_name" id="role_name" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="role_description" class="block text-gray-700 text-sm font-bold mb-2">Description du Rôle:</label>
            <textarea name="role_description" id="role_description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Permissions:</label>
            <div id="permissions-container" class="border rounded p-3">
                <?php 
                    foreach ($permissions as $permission): ?>
                    <label class="block mb-2">
                        <input type="checkbox" name="permissions[]" value="<?php echo $permission['id']; ?>" class="mr-2 leading-tight">
                            <span class="text-gray-700"><?php echo $permission['name']; ?></span>
                    </label>
                    <?php endforeach; ?>
            </div>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Ajouter Rôle
        </button>

    </form>
    <div id="message-container" class="mt-4 max-w-2xl mx-auto">
    </div>
</div>