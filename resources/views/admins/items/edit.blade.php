<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('admins.items.edit', $item) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden p-6">
                <form action="{{ route('admins.items.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="{{ $item->name }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="type" name="type_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $item->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-6">
                        <label for="rarity" class="block text-sm font-medium text-gray-700">Rarity</label>
                        <select id="rarity" name="rarity_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                            @foreach($rarities as $rarity)
                                <option value="{{ $rarity->id }}" {{ $item->rarity_id == $rarity->id ? 'selected' : '' }}>{{ $rarity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-6">
                        <label for="power" class="block text-sm font-medium text-gray-700">Power</label>
                        <input type="number" id="power" name="power" value="{{ $item->power }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="speed" class="block text-sm font-medium text-gray-700">Speed</label>
                        <input type="number" id="speed" name="speed" value="{{ $item->speed }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="durability" class="block text-sm font-medium text-gray-700">Durability</label>
                        <input type="number" id="durability" name="durability" value="{{ $item->durability }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="magic" class="block text-sm font-medium text-gray-700">Magic</label>
                        <input type="number" id="magic" name="magic" value="{{ $item->magic }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>
                    <div class="flex items-center justify-end gap-2 mt-4">
                        <a href="{{ route('admins.items.index') }}"
                           class="px-4 py-2 rounded-full bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 transition duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white font-semibold hover:shadow-md transition duration-200">
                            Update Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
