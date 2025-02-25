<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('trades.create') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="container">
                    <!-- Item Details -->
                    <div class="container flex items-center justify-between mb-4">
                        <h3 class="text-2xl font-bold mb-4">Item Details</h3>
                    </div>

                    <p class="text-gray-700 mb-6"><strong>Name:</strong> {{ $item->name }}</p>
                    <p class="text-gray-700 mb-6"><strong>Type:</strong> {{ $item->type->name }}</p>
                    <p class="text-gray-700 mb-6"><strong>Rarity:</strong> {{ $item->rarity->name }}</p>
                    <p class="text-gray-700 mb-6"><strong>Power:</strong> {{ $item->power }}</p>
                    <p class="text-gray-700 mb-6"><strong>Speed:</strong> {{ $item->speed }}</p>
                    <p class="text-gray-700 mb-6"><strong>Durability:</strong> {{ $item->durability }}</p>
                    <p class="text-gray-700 mb-6"><strong>Magic:</strong> {{ $item->magic }}</p>
                    <p class="text-gray-700 mb-6"><strong>Quantity:</strong> {{ $quantity }}</p>

                    <!-- Trade Form -->
                    <div class="container flex items-center justify-between mb-4">
                        <h3 class="text-2xl font-bold mb-4">Create Trade Request</h3>
                    </div>

                    <form method="POST" action="{{ route('trades.store') }}">
                        @csrf
                        <input type="hidden" name="receiving_item_id" value="{{ $item->id }}">
                        <input type="hidden" name="receiving_user_id" value="{{ $user->id }}">

                        <div class="mb-4">
                            <label for="sending_item_id" class="block text-gray-700">Sending Item</label>
                            <select name="sending_item_id" id="sending_item_id" class="block mt-1 w-full">
                                @foreach(auth()->user()->items as $userItem)
                                    <option value="{{ $userItem->id }}">{{ $userItem->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="sending_quantity" class="block text-gray-700">Sending Quantity</label>
                            <input type="number" name="sending_quantity" id="sending_quantity" class="block mt-1 w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="receiving_quantity" class="block text-gray-700">Receiving Quantity (max: {{$quantity}})</label>
                            <input type="number" name="receiving_quantity" id="receiving_quantity" class="block mt-1 w-full" max="{{ $quantity }}" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Create Trade
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
