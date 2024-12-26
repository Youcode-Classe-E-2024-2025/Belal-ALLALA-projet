<div class="edit-task-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
   <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
      <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
         <i class="fa-solid fa-xmark"></i>
      </button>
      <form class="space-y-3" action="/?edit=1&id=test" method="POST">
         <div class="hidden">
            <label for="id" class="block text-sm/6 font-medium text-gray-900">id</label>
            <input type="text" placeholder="id" name="id" id="id" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="title" class="block text-sm/6 font-medium text-gray-900">title</label>
            <input type="text" placeholder="title" name="title" id="title" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="description" class="block text-sm/6 font-medium text-gray-900">description</label>
            <input placeholder="description" type="text" name="description" id="description" autocomplete="description" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="deadline" class="block text-sm/6 font-medium text-gray-900">deadline</label>
            <input placeholder="YYYY-MM-DD HH:MM:SS" type="datetime" name="deadline" id="deadline" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="statut" class="block text-sm/6 font-medium text-gray-900">status</label>
            <select name="statut" id="statut" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
               <option value="Todo">Todo</option>
               <option value="Doing">Doing</option>
               <option value="Done">Done</option>
            </select>
         </div>
         <div>
            <label for="type" class="block text-sm/6 font-medium text-gray-900">type</label>
            <select name="type" id="type" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
               <option value="Basic">Basic</option>
               <option value="Bug">Bug</option>
               <option value="Feature">Feature</option>
            </select>
         </div>

         <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
         </div>
      </form>
   </div>
</div>