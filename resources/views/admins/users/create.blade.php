<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ Breadcrumbs::render('admins.users.create') }} --}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden p-6">
                <form action="{{ route('admins.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>

                    <div class="form-group mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>

                    <div class="form-group mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>

                    <div class="form-group mb-6">
                        <label for="role_id" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select name="role_id" id="role_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-end gap-2 mt-4">
                        <a href="{{ route('admins.users.index') }}"
                            class="px-4 py-2 rounded-full bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 transition duration-200">
                            Annuleren
                        </a>
                        <button type="submit"
                            class="px-4 py-2 rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white font-semibold hover:shadow-md transition duration-200">
                            Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
