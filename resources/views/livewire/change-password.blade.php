<div>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
        <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
          Change Email and Password
        </h2>

        <div x-data="{ email: '', password: '', confirmPassword: '', error: '', success: '' }">
          <form @submit.prevent="if (password === confirmPassword) { $wire.changeCredentials(email, password) } else { error = 'Passwords do not match'; }" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
              <input type="email" x-model="email" name="email" id="email" 
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                     placeholder="name@company.com" required>
            </div>

            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
              <input type="password" x-model="password" name="password" id="password" 
                     placeholder="••••••••" 
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                     required>
            </div>

            <div>
              <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
              <input type="password" x-model="confirmPassword" name="confirm-password" id="confirm-password" 
                     placeholder="••••••••" 
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                     required>
            </div>

            <!-- Error Message Display -->
            <div x-show="error" class="text-sm text-red-600">
              <span x-text="error"></span>
            </div>

            <!-- Success Message Display -->
            <div x-show="success" class="text-sm text-green-600">
              <span x-text="success"></span>
            </div>

            <button type="submit" class="w-full text-white bg-red-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              Reset Credentials
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
