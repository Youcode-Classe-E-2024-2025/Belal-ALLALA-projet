<div  class="member-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
    <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
        <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <?php 
            $teamMember = new TeamMember($db);
            $users = User::getAllUsers();
        ?>
        <table class="min-w-full w-full table-auto border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Members</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php 
                    foreach($users['users'] as $user){
                        if ($teamMember->isTeamMember($group_id, $user['id'])){
                ?>
                <tr class="border-t hover:bg-indigo-50">
                    <td class="px-4 py-2"><?php echo $user['id'] ?></td>
                    <td class="px-4 py-2"><?php echo $user['name'] ?></td>
                </tr>
                <?php } }?>
            </tbody>
        </table>
    </div>
</div>
