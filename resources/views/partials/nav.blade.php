<div class="relative bg-white w-full">
    <div class="w-full">
      <div class="flex justify-between border-b-2 border-gray-100 py-6 md:space-x-10 w-full text-center">
        <div>
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
              <span class="block xl:inline">Level 1</span>
              <span class="block text-indigo-600 xl:inline">Test</span>
            </h1>
        </div>
        <div clas="mr-auto mx-2">
          @auth
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a :href="route('logout')"
                onclick="event.preventDefault();
                        this.closest('form').submit();" 
                type="button" 
                class="pt-2 inline-flex cursor-pointer items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Logout
              </a>
            </form>
          @else
            <a href="{{ route('login') }}" class="pt-2 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Login</a>
            <a href="{{ route('register') }}" class="pt-2 inline-flex items-center rounded-md px-4 py-2 text-sm font-medium text-indigo-700 hover:text-indigo-500">Register</a>
          @endauth
        </div>
      </div>
    </div>
</div>
  