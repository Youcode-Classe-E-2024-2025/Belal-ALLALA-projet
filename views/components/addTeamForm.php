<?php require 'controllers/addteams.php' ?>
<div  class="add-team-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
   <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
      <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
         <i class="fa-solid fa-xmark"></i>
      </button>
      <form  method='post' class="space-y-3" action="/?edit=1&id=test" >
         <div>
            <label for="name" class="block text-sm/6 font-medium text-gray-900" >team name</label>
            <input type="text" placeholder="team name" name="name" id="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="ajouter">Add team</button>
         </div>
      </form>
   </div>
</div>