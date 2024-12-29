<div class="flex flex-col w-screen h-screen overflow-auto text-gray-700 bg-gradient-to-tr from-blue-200 via-indigo-200 to-pink-200">
   <div class="px-10 mt-6 flex gap-4 items-center">

      <h1 class="text-2xl font-bold">Team Project Board</h1>
      
      <?php if ($admin_id===NULL || $admin_id===$user_id){ ?>

         <button class="add-task-btn text-[12px] flex items-center p-1 font-medium bg-white/50 rounded-full shadow-md text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            NEW TASK
         </button>

      <?php } ?>

      <?php if ($group_id===NULL){ ?>

         <button class="add-team-btn text-[12px] flex items-center p-1 font-medium bg-white/50 rounded-full shadow-md text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100">
            <svg class="w-5 h-5 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            NEW TEAM
         </button>

      <?php } ?>
      
      <?php if ($admin_id===$user_id){ ?>

         <button class="add-member-btn text-[12px] flex items-center p-1 font-medium bg-white/50 rounded-full shadow-md text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100">
            <svg class="w-5 h-5 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            ADD MEMBER
         </button>

      <?php } ?>

      <?php if ($admin_id===$user_id){ ?>

         <button class="member-btn text-[12px] flex items-center p-1 font-medium bg-white/50 rounded-full shadow-md text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100">
            MEMBERS
         </button>

      <?php } ?>
      
      <?php $teammodel = new TeamMember($db);
         $teams = $teammodel->getTeamsByUser($user_id);
      ?>

      <select name="selectedTeam" id="selectedTeam" class="outline-none px-2 py-1 rounded-md">
         <option value="NULL" selected>personal</option>
         <?php
            foreach ($teams as $team){
               echo "<option value='".$team['id']."'>".$team['name']."</option>";
            }
         ?>
      </select>

   </div>
   <div class="flex flex-grow px-10 mt-4 space-x-6 overflow-auto">
      <?php require_once 'controllers/task.php' ?>
      <div id="todo" class="flex flex-col flex-shrink-0 flex-1">
         <div class="flex items-center flex-shrink-0 h-10 px-2">
            <span class="block text-sm font-semibold">Todo</span>
            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30"><?php echo count($todoTasks) ?></span>
         </div>
         <div class="flex flex-col pb-2 overflow-auto">
            <?php require 'views/components/task_todo.php' ?>
         </div>
      </div>
      <div id="doing" class="flex flex-col flex-shrink-0 flex-1">

         <div class="flex items-center flex-shrink-0 h-10 px-2">
            <span class="block text-sm font-semibold">doing</span>
            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30"><?php echo count($doingTasks) ?></span>
         </div>

         <div class="flex flex-col pb-2 overflow-auto">
            <?php require 'views/components/task_doing.php' ?>
         </div>

      </div>
      <div id="done" class="flex flex-col flex-shrink-0 flex-1">

         <div class="flex items-center flex-shrink-0 h-10 px-2">
            <span class="block text-sm font-semibold">done</span>
            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30"><?php echo count($doneTasks) ?></span>
         </div>

         <div class="flex flex-col pb-2 overflow-auto">
            <?php require 'views/components/task_done.php' ?>
         </div>

      </div>
   </div>
</div>
</body>

</html>