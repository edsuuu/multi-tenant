<x-guest-layout>
    <div class="w-full h-screen flex items-center justify-center text-black border border-black" id="content">
        <livewire:scheduling.auth.reset-password :token="request()->route('token')" />
    </div>
</x-guest-layout>
