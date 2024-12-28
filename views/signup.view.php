<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 ">
   <h2 class=" text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create an account</h2>
   <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-3" action="/signup" method="POST">
         <?= isset($error) ? "<div class='bg-red-200 text-red-600 text-center'>-- $error --</div>" : '' ?>
         <div>
            <label for="fullname" class="block text-sm/6 font-medium text-gray-900">fullname</label>
            <input type="text" name="fullname" id="fullname" autocomplete="fullname" placeholder="fullname" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <input type="email" name="email" id="email" autocomplete="email" placeholder="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>

         <div>
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" autocomplete="current-password" placeholder="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="confirm-password" class="block text-sm/6 font-medium text-gray-900">Confirm-password</label>
            <input type="password" name="confirm-password" id="confirm-password" autocomplete="confirm-password" placeholder="confirm-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>

         <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
         </div>
   </div>
   </form>

   <p class="mt-10 text-center text-sm/6 text-gray-500">
      Already have an account?
      <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Login</a>
   </p>
</div>
</div>