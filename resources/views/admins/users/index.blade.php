<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ Breadcrumbs::render('admins.users.index') }} --}}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @livewire('users-table')
    </div>
    <a href="{{ route('admins.users.create') }}" class="fixed bottom-8 right-8 bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white px-5 py-3 rounded-full shadow-lg text-lg hidden lg:block">
        +
    </a>
</x-app-layout>
