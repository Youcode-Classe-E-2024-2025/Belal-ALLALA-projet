<div class="flex flex-col w-screen h-screen overflow-auto text-gray-700 bg-gradient-to-tr from-blue-200 via-indigo-200 to-pink-200">

   <div class="px-10 mt-6 flex gap-4 items-center">

      <h1 class="text-2xl font-bold">Team Project Board</h1>
      
      <?php if ($admin_id === $user_id || $group_id===NULL){ ?>

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
       
      <?php require "controllers/selectTeam.php"  ?>
      <form method="post" class="flex justify-center space-x-2" >
         <select name="selectedTeam" id="selectedTeam" data-select='{
            "placeholder": "<span class=\"inline-flex items-center\"><span class=\"icon-[tabler--filter] flex-shrink-0 size-4 me-2\"></span> Filter</span>",
            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
            "toggleClasses": "advance-select-toggle",
            "dropdownClasses": "advance-select-menu",
            "optionClasses": "advance-select-option selected:active",
            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] flex-shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
            "extraMarkup": "<span class=\"icon-[tabler--caret-up-down] flex-shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
            }' class="outline-none px-2 py-1 rounded-md ">
            <option value="" selected>personal</option>
            <?php
               foreach ($teams as $team) {
                  echo "<option value='" . htmlspecialchars($team['id']) . "'>" . htmlspecialchars($team['name']) . "</option>";
               }
            ?>
         </select>
         <button type="submit" class="member-btn text-[12px] flex items-center  font-medium bg-white/50 rounded-full shadow-md text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100 px-4 ">Select</button>
      </form>

      <div>
         <a href="views/dashbord/dashbord.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
               <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
               <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
            </svg>
         </a>
      </div>
   </div>
   <div class="flex flex-grow px-10 mt-4 space-x-6 overflow-auto">
      <?php require_once 'controllers/task.php' ?>
      <div id="todo" class="flex flex-col flex-shrink-0 flex-1 border border-2 rounded-lg border-white mb-4">
         <div class="flex items-center justify-center flex-shrink-0 h-10 px-2 ">
            <span class="block text-sm font-semibold">Todo</span>
            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30"><?php echo count($todoTasks) ?></span>
         </div>

         <div class="w-full border border-1 border-black"></div>

         <div class="flex flex-col overflow-auto p-2 ">
            <?php require 'views/components/task_todo.php' ?>
         </div>
      </div>

      <div id="doing" class="flex flex-col flex-shrink-0 flex-1 border border-2 rounded-lg border-white mb-4">

         <div class="flex items-center flex-shrink-0 h-10 px-2 justify-center">
            <span class="block text-sm font-semibold">doing</span>
            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30"><?php echo count($doingTasks) ?></span>
         </div>

         <div class="w-full border border-1 border-black"></div>

         <div class="flex flex-col overflow-auto p-2">
            <?php require 'views/components/task_doing.php' ?>
         </div>

      </div>
      <div id="done" class="flex flex-col flex-shrink-0 flex-1 border border-2 rounded-lg border-white mb-4">

         <div class="flex items-center flex-shrink-0 h-10 px-2 justify-center">
            <span class="block text-sm font-semibold">done</span>
            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30"><?php echo count($doneTasks) ?></span>
         </div>

         <div class="w-full border border-1 border-black"></div>

         <div class="flex flex-col overflow-auto p-2">
            <?php require 'views/components/task_done.php' ?>
         </div>

      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
</body>

</html>