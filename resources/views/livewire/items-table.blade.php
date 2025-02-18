<div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
    <!-- Search bar -->
    <div class="flex gap-2 items-center p-4 bg-[#faa202]">
        <div class="w-full">
            <input wire:model.live.debounce.500ms="search" type="text"
                   class="bg-gray-50 text-gray-900 text-sm rounded-full border-none focus:ring-0 focus:border-none block w-full p-3 placeholder-gray-400"
                   placeholder="Search an item...">
        </div>
    </div>

    <table class="w-full text-sm text-left">
        <thead class="bg-[#faa202] text-white uppercase text-xs tracking-wider">
        <tr>
            <th scope="col" class="px-4 py-3 font-semibold">Name</th>
            <th scope="col" class="px-4 py-3 font-semibold hidden sm:table-cell">Type</th>
            <th scope="col" class="px-4 py-3 font-semibold hidden sm:table-cell">Rarity</th>
            <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="hover:bg-gray-50 transition duration-150 cursor-pointer" >
                <td onclick="window.location='{{ route('items.show', $item) }}'" class="px-4 py-3 font-medium text-gray-900">
                    {{ $item->name }} ({{ $item->total_quantity > 0 ? $item->total_quantity . 'x' : '0x' }})
                </td>
                <td onclick="window.location='{{ route('items.show', $item) }}'" class="px-4 py-3 text-gray-700 hidden sm:table-cell">{{ $item->type->name }}</td>
                <td onclick="window.location='{{ route('items.show', $item) }}'" class="px-4 py-3 text-gray-700 hidden sm:table-cell">{{ $item->rarity->name }}</td>
                <td class="px-4 py-3 flex items-center justify-end gap-2"></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="py-4 px-3">
        <div class="flex items-center justify-between gap-2 flex-wrap">
            <div class="flex items-center gap-4 w-full sm:w-auto">
                <label class="text-sm text-gray-700 leading-5">Per page</label>
                <select wire:model.live="perPage"
                        class="text-gray-900 text-sm rounded-full focus:ring-[#faa202] focus:border-[#faa202] block w-full sm:w-auto pr-8 pl-3 p-2.5 border-gray-300 appearance-none">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="w-full sm:w-auto mt-4 sm:mt-0">
                {{ $items->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
