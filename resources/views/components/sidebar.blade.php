{{--
    Sidebar component (Blade partial)

    Purpose:
    - Renders the application's left navigation pane used across the chat app layout.
    - Contains a responsive toggle button, search input, and action links (Profile, Settings, Logout).

    Behaviour notes:
    - `#toggleButton` is targeted by front-end JS to expand/collapse the sidebar width.
    - The search `input` is purely presentational here; wire up event handlers in `resources/js/app.js` when needed.
    - Tooltips shown on the right are implemented via CSS utility classes; they are non-interactive (pointer-events-none).
    - Use Blade comments (this block) to avoid rendering documentation in HTML output.
--}}
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

            {{-- Profile link
                - Icon + label for user profile navigation.
                - Uses the `group` utility so the tooltip fades in on hover (`group-hover:opacity-100`).
                - Replace `href="#"` with a route when actual profile page exists (e.g. route('profile')).
            --}}
            <a href="#" class="group relative flex items-center gap-3 p-2 rounded-md
                  hover:bg-blue-500 hover:text-white transition">
                <i class="fa-solid fa-user"></i>

                <span class="label">PROFILE</span>

                {{-- Tooltip: small helper text that appears on hover. Non-interactive. --}}
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

        {{-- Logout form
            - Posts to `route('logout')` to end the authenticated session.
            - `@csrf` ensures the POST request is protected against CSRF attacks.
            - The button is full-width and left-aligned for accessibility and touch targets.
        --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="group relative flex items-center gap-3 p-2 rounded-md
                  hover:bg-blue-500 hover:text-white transition w-full text-left">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="label">LOGOUT</span>

                {{-- Tooltip: explains the button; rendered on hover but disabled for interaction. --}}
                <span class="absolute left-full ml-3 px-2 py-1 text-sm rounded-md
                       bg-gray-900 text-white opacity-0
                       group-hover:opacity-100 transition
                       whitespace-nowrap cursor-not-allowed pointer-events-none">
                    Logout
                </span>
            </button>
        </form>
    </div>
</aside>
