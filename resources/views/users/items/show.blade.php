<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{--            {{ Breadcrumbs::render('user.items.show', $item) }}--}}
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
