<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-behavior: smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

<nav
    class="w-full border-b border-b-blue-link bg-blue-black text-white flex flex-row justify-between px-10 items-center p-4"
    id="navbar">
    <div>
        <h2><a href="{{ route('home') }}">Logo</a></h2>
    </div>
    <div class="flex flex-row list-none gap-4">
        <ul class="flex gap-7">
            <li><a href="" class="hover:underline font-medium">Soluções</a></li>
            <li><a href="" class="hover:underline font-medium">Recursos</a></li>
            <li><a href="" class="hover:underline font-medium">Planos</a></li>
        </ul>
    </div>
    @if(auth()->check())
        <div class="flex flex-row gap-2">
            {{--            @if((auth()->user()->business || auth()->user()->role === 'admin') && !request()->is('complete-profile'))--}}
            <h1><a href="{{ route('dashboard') }}">Dashboard</a></h1>
            {{--            @else--}}
            <h1><a href="{{ route('complete-profile') }}">Complete seu Cadastro</a></h1>
            {{--            @endif--}}
            <a wire:click="logout">Sair</a>
        </div>
    @else
        <div class="flex flex-row gap-4 items-center">
            <a href="{{ route('login') }}" class="hover:underline font-medium">Login</a>
            <button class="py-[5px] px-[17px] bg-blue-white rounded-[6px] font-medium active:scale-[0.97]" onclick="window.location='{{ route('register') }}'">
                Comece já
            </button>
        </div>
    @endif
</nav>
<main class="w-full max-w-[1920px] mx-auto">
    {{ $slot }}
</main>

@livewireScripts
</body>
</html>
