<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--            {{ Breadcrumbs::render('dashboard') }}--}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-800">Welkom, {{ auth()->user()->name }}</h1>
                <p class="text-gray-600 mt-2">Dit is de dashboard van de applicatie. Hier kan je alle informatie vinden die je nodig hebt.</p>
            </div>
        </div>
    </div>
</x-app-layout>
