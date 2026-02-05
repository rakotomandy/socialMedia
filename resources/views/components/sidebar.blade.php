<aside class="flex flex-col w-fit h-screen gap-3 bg-blue-100 shadow-md p-2 transition-[width] duration-300">
    <div class="flex items-center justify-between">
        <h1 class="label font-bold text-xl">CHAT APP</h1>
        <button id="toggleButton" class="hover:cursor-pointer text-xl">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <hr>
    <div class="flex-1">
        <input class="bg-white p-2 rounded-md outline-none w-full focus:ring-2 focus:ring-blue-400" type="text" placeholder="search">
    </div>
    <hr class="h-2 shadow-sm">
    <div class="flex flex-col gap-4">

        <!-- Profile -->
        <a href="#" class="group relative flex items-center gap-3 p-2 rounded-md
              hover:bg-blue-500 hover:text-white transition">
            <i class="fa-solid fa-user"></i>

            <span class="label">PROFILE</span>

            <!-- Tooltip -->
            <span class="absolute left-full ml-3 px-2 py-1 text-sm rounded-md
                   bg-gray-900 text-white opacity-0
                   group-hover:opacity-100 transition
                   whitespace-nowrap pointer-events-none">
                Profile
            </span>
        </a>

        <!-- Settings -->
        <a href="#" class="group relative flex items-center gap-3 p-2 rounded-md
              hover:bg-blue-500 hover:text-white transition">
            <i class="fa-solid fa-cog"></i>
            <span class="label">SETTINGS</span>

            <span class="absolute left-full ml-3 px-2 py-1 text-sm rounded-md
                   bg-gray-900 text-white opacity-0
                   group-hover:opacity-100 transition
                   whitespace-nowrap pointer-events-none">
                Settings
            </span>
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="group relative flex items-center gap-3 p-2 rounded-md
                  hover:bg-blue-500 hover:text-white transition w-full text-left">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="label">LOGOUT</span>

                <span class="absolute left-full ml-3 px-2 py-1 text-sm rounded-md
                       bg-gray-900 text-white opacity-0
                       group-hover:opacity-100 transition
                       whitespace-nowrap pointer-events-none">
                    Logout
                </span>
            </button>
        </form>
    </div>
</aside>
