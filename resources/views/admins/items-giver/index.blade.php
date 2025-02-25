<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ Breadcrumbs::render('admins.items-giver.index') }} --}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden p-6">
                <form action="{{ route('admins.items-giver.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-6">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-6">
                        <label for="item_id" class="block text-sm font-medium text-gray-700">Item</label>
                        <select name="item_id" id="item_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input placeholder="Both negative and positive numbers van be used." type="number" id="quantity" name="quantity" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>

                    <div class="flex items-center justify-end gap-2 mt-4">
                        <a href="{{ route('admins.items-giver.index') }}"
                           class="px-4 py-2 rounded-full bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 transition duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white font-semibold hover:shadow-md transition duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
