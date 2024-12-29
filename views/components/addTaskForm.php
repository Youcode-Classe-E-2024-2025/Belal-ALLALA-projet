<?php require 'controllers/task/add.php' ?>
<div class="add-task-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
   <div class="w-full rounded-xl max-w-sm p-4 bg-white relative">

      <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
         <i class="fa-solid fa-xmark"></i>
      </button>

      <form class="space-y-2" action="/home" method="post">
         <?= isset($error) ? "<div class='text-red-600 bg-red-200 font-bold'>-- $error --</div>" : '' ?>

         <div class="hidden">
            <label for="action" class="block text-sm font-medium text-gray-900">action</label>
            <input type="text" placeholder="action" name="action" id="action" value="add" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
         </div>

         <div class="!mt-0">
            <label for="title" class="block text-sm font-medium text-gray-900">title</label>
            <input type="text" placeholder="title" name="title" id="title" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
         </div>

         <div>
            <label for="description" class="block text-sm font-medium text-gray-900">description</label>
            <input placeholder="description" type="text" name="description" id="description" autocomplete="description" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
         </div>

         <div>
            <label for="deadline" class="block text-sm font-medium text-gray-900">deadline</label>
            <div class="flex gap-2">
               <input type="date" name="date" id="deadline" required class="flex-[4] block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
               <input type="time" name="time" id="deadline" required class="flex-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
            </div>
         </div>

         <div>
            <label for="statut" class="block text-sm font-medium text-gray-900">status</label>
            <select name="statut" id="statut" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
               <option value="Todo">Todo</option>
               <option value="Doing">Doing</option>
               <option value="Done">Done</option>
            </select>
         </div>

         <div>
            <label for="type" class="block text-sm font-medium text-gray-900">type</label>
            <select name="type" id="type" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
               <option value="Basic">Basic</option>
               <option value="Bug">Bug</option>
               <option value="Feature">Feature</option>
            </select>
         </div>

         <?php if ($group_id !== NULL){ ?>
            <?php 
               $teamMember = new TeamMember($db);
               $users = User::getAllUsers();
            ?>
            <div>
               <label for="assignedTo" class="block text-sm font-medium text-gray-900">assign to:</label>
               <select name="assignedTo" id="assignedTo" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                  <?php 
                     foreach($users['users'] as $user){
                        if ($teamMember->isTeamMember($group_id, $user['id'])){
                           echo "<option value='".$user['id']."'>".$user['name']."</option>";
                        }
                     }
                  ?>
               </select>
            </div>

         <?php } ?>

         <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="addTask">Add task</button>
      </form>
   </div>
</div>