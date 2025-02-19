<div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
    <!-- Search bar -->
    <div class="flex gap-2 items-center p-4 bg-[#faa202]">
        <div class="w-full">
            <input wire:model.live.debounce.500ms="search" type="text"
                   class="bg-gray-50 text-gray-900 text-sm rounded-full border-none focus:ring-0 focus:border-none block w-full p-3 placeholder-gray-400"
                   placeholder="Search a trade...">
        </div>
    </div>

    <table class="w-full text-sm text-left">
        <thead class="bg-[#faa202] text-white uppercase text-xs tracking-wider">
        <tr>
            <th scope="col" class="px-4 py-3 font-semibold">Sender</th>
            <th scope="col" class="px-4 py-3 font-semibold">Receiver</th>
            <th scope="col" class="px-4 py-3 font-semibold">Sending Item</th>
            <th scope="col" class="px-4 py-3 font-semibold">Receiving Item</th>
            <th scope="col" class="px-4 py-3 font-semibold">Status</th>
            <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
        </tr>
        </thead>
        <tbody>
        @foreach($trades as $trade)
            <tr class="hover:bg-gray-50 transition duration-150 cursor-pointer">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $trade->sendingUser->name }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $trade->receivingUser->name }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $trade->sendingItem->name }}, {{$trade->sending_quantity}}x</td>
                <td class="px-4 py-3 text-gray-700">{{ $trade->receivingItem->name }}, {{$trade->receiving_quantity}}x</td>
                <td class="px-4 py-3 text-gray-700">{{ $trade->accepted }}</td>
                <td class="px-4 py-3 flex items-center justify-end gap-2">
                    @if($trade->accepted == 'pending')
                        @if(auth()->id() == $trade->receivingUser->id)
                            <form action="{{ route('trades.accept', $trade) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white font-semibold text-sm hover:shadow-md transition duration-200">
                                    Accept
                                </button>
                            </form>

                            <form action="{{ route('trades.deny', $trade) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 rounded-full bg-gradient-to-r from-[#e64a4a] to-[#610505] text-white font-semibold text-sm hover:shadow-md transition duration-200">
                                    Deny
                                </button>
                            </form>
                        @endif

                        @if(auth()->id() != $trade->receivingUser->id)
                            <form action="{{ route('trades.deny', $trade) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 rounded-full bg-gradient-to-r from-[#e64a4a] to-[#610505] text-white font-semibold text-sm hover:shadow-md transition duration-200">
                                    Cancel
                                </button>
                            </form>
                        @endif
                    @endif
                </td>
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
                {{ $trades->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
