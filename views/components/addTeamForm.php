<div class="add-team-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
   <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
      <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
         <i class="fa-solid fa-xmark"></i>
      </button>
      <form class="space-y-3" action="/?edit=1&id=test" method="POST">
         <div>
            <label for="name" class="block text-sm/6 font-medium text-gray-900">team name</label>
            <input type="text" placeholder="team name" name="name" id="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>

         <div>
            <label for="members" class="block text-sm/6 font-medium text-gray-900">members</label>
            <div class="flex items-center gap-2">
               <select name="type" id="members" class="selected-member block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  <option value="">-- select a member --</option>
                  <option value="1">karim</option>
                  <option value="2">ahmed</option>
                  <option value="3">ali</option>
                  <option value="4">ismail</option>
               </select>
               <button type="button" class="add-member-btn p-1 bg-white/50 rounded-full border border-gray-200 shadow-md text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                  </svg>
               </button>
            </div>
         </div>
         <div class="team-members">
            <h6>team members:</h6>
            <ul class="members">

            </ul>
         </div>
         <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add team</button>
         </div>
      </form>
   </div>
</div>