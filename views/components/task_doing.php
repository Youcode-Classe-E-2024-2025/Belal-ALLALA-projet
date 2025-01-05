<?php
   foreach($doingTasks as $doingTask){
?>
      <div id="3" class="task relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100" draggable="true">
         <div class="absolute top-0 right-0 text-gray-500 flex gap-2 pt-1 pr-1 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-aspect-ratio-fill" viewBox="0 0 16 16">
               <path d="M0 12.5v-9A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5M2.5 4a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0V5h2.5a.5.5 0 0 0 0-1zm11 8a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-1 0V11h-2.5a.5.5 0 0 0 0 1z"/>
            </svg>
            <a href="controllers/delete_task.php?id=<?php echo $doingTask['id'] ?>" class="delete-task-btn  active:scale-90" onclick="return confirm('Vouler vous vraiment supprimer cette tache')">
               <i class="fa-solid fa-xmark"></i>
            </a>
         </div>
         <span class="flex items-center h-6 px-3 text-xs font-semibold text-pink-500 bg-pink-100 rounded-full"><?php echo $doingTask['type'] ?></span>
         <h4 class="mt-3 text-sm font-medium"><?php echo $doingTask['titre'] ?></h4>
         <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
            <div class="flex items-center">
               <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
               </svg>
               <span class="ml-1 leading-none"><?php echo $doingTask['deadline'] ?></span>
            </div>
            <?php $users = Task::getUsersByTaskId($doingTask['id'], $db); ?>
            <?php if (!empty($users)): ?> 
               <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-gray-100 rounded-full">
                  <?php echo $users['name'] ?>
               </span>
            <?php else: ?>
               <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-gray-100 rounded-full">Non assigné</span>
            <?php endif; ?>
         </div>
         <a href="controllers/changeStatut.php?id=<?php echo $doingTask['id']; ?>" class="mt-3 w-full text-blue-500 px-3 py-1.5 rounded-md flex justify-center items-center">
         <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-green-100 rounded-full">change statut</span>
      </a>
      </div>
<?php } ?>