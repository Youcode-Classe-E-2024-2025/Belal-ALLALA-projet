<?php foreach($doneTasks as $doneTask){ ?>

   <div id="task" class="task relative flex flex-col items-start p-1 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100 " draggable="true">
      <div class="absolute top-0 right-0 text-gray-500 flex gap-2 pt-1 pr-1 items-center ">

         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-aspect-ratio-fill task-icon" viewBox="0 0 16 16">
            <path d="M0 12.5v-9A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5M2.5 4a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0V5h2.5a.5.5 0 0 0 0-1zm11 8a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-1 0V11h-2.5a.5.5 0 0 0 0 1z"/>
         </svg>

         <a href="controllers/delete_task.php?id=<?php echo $doneTask['id'] ?>" class="delete-task-btn active:scale-90" onclick="return confirm('Voulez-vous vraiment supprimer cette tâche?')">
            <i class="fa-solid fa-xmark"></i>
         </a>

      </div>

      <input type="hidden" name="task_id" value="<?php echo $doneTask['id'] ?>" >
      <span class="flex items-center h-6 px-2 text-xs font-semibold text-pink-500 bg-pink-100 rounded-full"><?php echo $doneTask['type'] ?></span>
      <h4 class=" text-sm font-medium"><?php echo $doneTask['titre'] ?></h4>
      <div class="flex w-full items-center ">
         <div class="flex items-center w-full text-xs font-medium text-gray-400  ">
            <div class="flex items-center">
               <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
               </svg>
               <span class="ml-1 leading-none"><?php echo $doneTask['deadline'] ?></span>
            </div>

            <?php $users = Task::getUsersByTaskId($doneTask['id'], $db); ?>
            <?php if (!empty($users)): ?> 
               <span class="flex items-center h-6 pl-2 text-xs font-semibold text-green-500 bg-gray-100 rounded-full">
                  <?php echo $users['name'] ?>
               </span>
            <?php else: ?>
               <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-gray-100 rounded-full">Non assigné</span>
            <?php endif; ?>
         </div>

         <a href="controllers/changeStatut.php?id=<?php echo $doneTask['id']; ?>" class="w-full text-blue-500 px-3 py-1.5 rounded-md flex justify-center items-center ">
            <span class="flex  items-center h-6 px-3 text-xs font-semibold text-green-500 bg-green-100 rounded-full ">change statut</span>
         </a>
      </div>
   </div>

   <div id="hiddenSection<?php echo $doneTask['id'] ?>" class="section-anim overlay hidden w-screen h-screen fixed top-0 left-0 z-20  flex items-center ">
      <div class="p-6 rounded-lg shadow-md bg-white w-1/2 h-full">
         <div class="flex items-center w-full justify-between">
            <h2 class="text-2xl font-bold mb-4 text-center mr-auto ml-auto"><?php echo $doneTask['titre'] ?></h2>
            <div class="flex items-center space-x-2 justify-end ">
               <i class="fas fa-edit"></i>
               <i class="close-btn fas fa-close"></i>
            </div>
         </div>
         <div class="space-y-6">
            <div class="flex items-center space-x-6">
               <span class="font-medium w-24 flex items-center ">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0040ff" class="bi bi-record-circle" viewBox="0 0 16 16">
                     <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                     <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  </svg>
                  <span class="ml-2">Status</span> 
               </span>

               <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                  Done
               </span>
            </div>

            <div class="flex items-center space-x-6">
               <span class="font-medium w-24 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff748c" class="bi bi-calendar4-event" viewBox="0 0 16 16">
                     <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                     <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                  </svg>
                  <span class="ml-2">Deadline</span> 
               </span>
               <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-pink-100 text-pink-500">
                  <?php echo $doneTask['deadline'] ?>
               </span>
            </div>

            <div class="flex items-center space-x-6">
               <span class="font-medium w-24 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#00e600" class="bi bi-person" viewBox="0 0 16 16">
                     <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                  </svg>
                  <span class="ml-2">Assignee</span> 
               </span>
               <div class="flex gap-2">
                  <div class="flex items-center space-x-2 bg-gray-100 rounded-full px-3 py-1">
                     <?php if (!empty($users)): ?> 
                        <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-gray-100 rounded-full">
                           <?php echo $users['name'] ?>
                        </span>
                     <?php else: ?>
                        <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-gray-100 rounded-full">Non assigné</span>
                     <?php endif; ?>
                  </div>
               </div>
            </div>

            <div class="flex items-center space-x-6">
               <span class="font-medium w-24 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                     <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z"/>
                     <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z"/>
                  </svg>
                  <span class="ml-2">Tags</span> 
               </span>

               <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mr-2"><?php echo $doneTask['type'] ?></span>
            </div>
         
            <div class="flex items-center space-x-6">
               <span class="font-medium w-24 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-bookmark" viewBox="0 0 16 16">
                     <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                  </svg>
                  <span class="ml-2">Categories</span>
               </span>
               <?php 
                  $categoryTaskModel = new CategoryTask($db);
                  $category=$categoryTaskModel->getCategoriesByTask($doneTask['id']);
                  foreach($category as $caty){
                     echo '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">' . $caty['name'] . '</span>';
                  }
               ?>
            </div>

            <div>
               <span class="font-medium  flex items-center ">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                     <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                     <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                  </svg>
                  <span class="ml-2">Description</span> 
               </span>
               <p class=" border p-4 rounded-lg bg-gray-50 text-start">
                  <?php echo $doneTask['description'] ?>
               </p>
            </div>
         </div>
      </div>
   </div>

<?php } ?>