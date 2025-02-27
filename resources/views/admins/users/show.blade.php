<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ Breadcrumbs::render('admins.users.show', $user) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden p-6">
                <div class="container flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold mb-4">Gebruiker</h3>
                    <div class="flex space-x-2">
                        <a href="{{ route('admins.users.edit', $user) }}"
                           class="text-white rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] hover:shadow-md transition duration-200 w-10 h-10 flex items-center justify-center">
                            <ion-icon name="pencil-outline" class="text-lg"></ion-icon>
                        </a>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Naam</label>
                    <div class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-gray-100">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">E-mail</label>
                    <div class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-gray-100">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Rol</label>
                    <div class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-gray-100">
                        @foreach($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
