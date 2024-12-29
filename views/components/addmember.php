<?php require 'controllers/addmember.php' ?>
<div  class="add-member-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
    <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
        <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <form  method='post' class="space-y-3" action="/?edit=1&id=test" >
            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900" >Members</label>

                <?php 
                    $teamMember = new TeamMember($db);
                    $users = User::getAllUsers();
                ?>

                <select name="selectedMember" id="selectedMember" class="outline-none px-2 py-1 rounded-md">
                    <?php
                        foreach ($users['users'] as $user){
                            if (!$teamMember->isTeamMember($group_id, $user['id'])){
                                echo "<option value='".$user['id']."'>".$user['name']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="ajouterMember">Add Member</button>
            </div>
        </form>
    </div>
</div>