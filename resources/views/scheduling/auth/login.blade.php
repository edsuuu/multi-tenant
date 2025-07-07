<x-guest-layout>
    <div class="w-full h-screen flex items-center justify-center text-black" id="content">
        <div id="informations-div" class="w-full bg-blue-black h-full flex items-center justify-center text-white transition-transform duration-700 z-10">
            <h1 class="text-3xl font-semibold text-white-color" id="infos-text">Login</h1>
        </div>

        <div id="blue-div" class="w-full flex items-center justify-center text-white transition-transform duration-700">
            <livewire:auth.form-login/>
        </div>
    </div>
</x-guest-layout>
