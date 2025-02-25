<div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
    <!-- Zoekbalk -->
    <div class="flex gap-2 items-center p-4 bg-[#faa202]">
        <div class="w-full flex gap-2">
            <input wire:model.live.debounce.500ms="search" type="text"
                   class="bg-gray-50 text-gray-900 text-sm rounded-full border-none focus:ring-0 focus:border-none block w-full p-3 placeholder-gray-400"
                   placeholder="Zoek een user...">
            <select wire:model.live="roleId" class="text-gray-900 text-sm rounded-full focus:ring-[#faa202] focus:border-[#faa202] block w-full sm:w-auto pr-8 pl-3 p-2.5 border-gray-300 appearance-none">
                <option value="">Alle Rollen</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="w-full text-sm text-left">
        <thead class="bg-[#faa202] text-white uppercase text-xs tracking-wider">
        <tr>
            <th scope="col" class="px-4 py-3 font-semibold">Naam</th>
            <th scope="col" class="px-4 py-3 font-semibold hidden sm:table-cell">Email</th>
            <th scope="col" class="px-4 py-3"><span class="sr-only">Acties</span></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="hover:bg-gray-50 transition duration-150 cursor-pointer" >
                <td onclick="window.location='{{ route('admins.users.show', $user) }}'" class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                <td onclick="window.location='{{ route('admins.users.show', $user) }}'" class="px-4 py-3 text-gray-700 hidden sm:table-cell">{{ $user->email }}</td>
                <td class="px-4 py-3 flex items-center justify-end gap-2">
                    @if($user->id != auth()->id())
                        <button onclick="confirmDeleteUser({{ $user->id }}, '{{ $user->name }}')"
                                class="px-4 py-2 rounded-full bg-red-500 text-white font-semibold text-sm hover:bg-red-600 hover:shadow-md transition duration-200">
                            Verwijderen
                        </button>
                    @endif
                    <a href="{{ route('admins.users.edit', $user) }}"
                       class="px-4 py-2 rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white font-semibold text-sm hover:shadow-md transition duration-200">
                        Bewerken
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="py-4 px-3">
        <div class="flex items-center justify-between gap-2 flex-wrap">
            <div class="flex items-center gap-4 w-full sm:w-auto">
                <label class="text-sm text-gray-700 leading-5">Per pagina</label>
                <select wire:model.live="perPage"
                        class="text-gray-900 text-sm rounded-full focus:ring-[#faa202] focus:border-[#faa202] block w-full sm:w-auto pr-8 pl-3 p-2.5 border-gray-300 appearance-none">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="w-full sm:w-auto mt-4 sm:mt-0">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 en jQuery laden als ze nog niet in je project zitten -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmDeleteUser(id, name) {
        Swal.fire({
            title: "Weet je zeker dat je de user '" + name + "' wilt verwijderen?",
            text: "Dit kan niet ongedaan worden gemaakt!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ja, verwijderen!",
            cancelButtonText: "Annuleren",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admins.users.destroy', '') }}/" + id,
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Verwijderd!",
                            text: "De user is succesvol verwijderd.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: "Fout!",
                            text: "De user kon niet worden verwijderd.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>
