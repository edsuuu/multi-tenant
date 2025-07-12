<div class="flex flex-row justify-between lg:hidden border border-black">
    <div>
        <button
            x-data
            x-on:click="$dispatch('toggle-sidebar')"
            class="p-2 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-white"
        >
            button
        </button>
    </div>

    <header class="bg-[#F8F9FA] px-4 md:px-6 py-3 flex justify-between items-center">
        <div class="relative" x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false">
            <button @click="open = !open" class="flex items-center">

                abrir perfil
            </button>

            <div x-show="open" x-transition class="absolute right-0 mt-2 w-[90vw] max-w-[350px] bg-white rounded-md shadow-2xl z-10" style="display: none;">
                <div class="p-4 border-b border-zinc-200">
                    <div class="flex flex-row items-center gap-3 mb-3">
                        <div class="shrink-0 w-10 h-10 bg-zinc-100 rounded-full flex items-center justify-center">
                            <span class="text-zinc-600 font-medium text-sm">e</span>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="font-semibold text-zinc-900 truncate">etesda@amsikdnmasa</span>
                            <span class="text-sm text-zinc-500 truncate">etesda@amsikdnmasa.com</span>
                        </div>
                    </div>
                </div>

                <!-- Menu Items -->
                <div class="py-2">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-zinc-700 hover:bg-zinc-50 transition-colors">
                        <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm">Settings</span>
                    </a>

                    <form method="POST" action="" x-data class="block">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2 text-zinc-700 hover:bg-zinc-50 transition-colors text-left">
                            <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="text-sm">Log Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
</div>


<div class="hidden lg:block fixed inset-y-0 left-0 w-64 bg-blue-black transform transition-transform duration-200 ease-in-out translate-x-0">
    @include('layout.navbar-links')
</div>
