<div class="flex flex-col h-screen">
    <div class="p-4">
        Logo
    </div>

    <div class="flex-1 overflow-y-auto pr-1 pb-5 cst-scrollbar">
        <div class="flex flex-col gap-1">
            <p class="text-[14px] font-bold ml-5 mt-4">Testeee </p>

            <a href="" wire:navigate
               class="text-white rounded-md hover:bg-blue-link transition-all duration-200 {{ request()->routeIs('home') && !request('status') ? 'bg-blue-link' : '' }}">
                <div class="flex flex-row gap-2 items-center">
                    icon
                    <span class="text-[14.5px]">teste </span>
                </div>
            </a>

            <div
                x-cloak
                x-data="{ open: {{ request()->routeIs(['home']) ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button"
                        class="w-full flex flex-row items-center gap-1 text-white rounded-md p-3 px-4 bg-blue-link transition-all duration-200"
                        :class="{ ' bg-blue-link ': open }">
                    <img src="" class="w-6 h-6" alt="icon_dash"/>
                    <span class="flex-1  text-left rtl:text-right whitespace-nowrap">DROPDOWN</span>
                    <svg class="w-3 h-3 transition-transform" :class="{ 'transform rotate-180': open }"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <div x-ref="submenu" x-show="open" x-transition x-collapse class="overflow-hidden">
                    <a href="{{ route('home') }}" wire:navigate
                       class="flex flex-row items-center gap-2 text-white rounded-md p-3 px-4 mt-1 bg-blue-link transition-all duration-200 {{ request()->routeIs('home') ? ' bg-blue-link ' : '' }}">
                        <span class="text-[14.5px]">SubLinkssss</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-lg:pb-10">
        <div class="hidden lg:block bg-white p-4 border-t border-zinc-200">
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
</div>
