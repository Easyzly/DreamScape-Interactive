<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ Breadcrumbs::render('admins.users.create') }} --}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden p-6">
                <form id="update-form" action="{{ route('admins.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>

                    <div class="form-group mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3" required>
                    </div>

                    <div class="form-group mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nieuw wachtwoord</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3">
                    </div>

                    <div class="form-group mb-6">
                        <label for="role_id" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select name="role_id" id="role_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#faa202] focus:border-[#faa202] p-3">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->first()->id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="flex items-center justify-between mt-4">
                    @if($user->id != auth()->id())
                        <!-- Delete Button with SweetAlert -->
                        <button type="button"
                                onclick="sendCheck({{ $user->id }}, '{{ $user->name }}')"
                                class="px-4 py-2 text-white font-semibold rounded-full bg-red-500 hover:bg-red-600 hover:shadow-md transition duration-200">
                            Verwijderen
                        </button>
                    @endif
                    @if($user->id == auth()->id())
                        <div></div>
                    @endif
                    <div class="flex items-center justify-end gap-2 mt-4">
                        <a href="{{ route('admins.users.index') }}"
                           class="px-4 py-2 rounded-full bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 transition duration-200">
                            Annuleren
                        </a>
                        <button type="submit" form="update-form" class="px-4 py-2 rounded-full bg-gradient-to-r from-[#4ae6d4] to-[#054162] text-white font-semibold hover:shadow-md transition duration-200">
                            Opslaan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 script -->

</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    function sendCheck(id, name) {
        Swal.fire({
            title: "Weet u zeker dat u de gebruiker " + name + " wilt verwijderen?",
            text: "Dit kan niet teruggedraaid worden!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ja, verwijderen!",
            cancelButtonText: "Annuleren",
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete the user
                $.ajax({
                    type: "POST",
                    url: "{{ route('admins.users.destroy', '') }}/" + id, // Correctly insert the user ID
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}" // Send CSRF token for validation
                    },
                    success: function (data) {
                        Swal.fire({
                            title: "Verwijderd!",
                            text: "Gebruiker is verwijderd",
                            icon: "success"
                        }).then(() => {
                            location.href = "{{ route('admins.users.index') }}"; // Redirect to users index after deletion
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: "Error!",
                            text: "Gebruiker kon niet verwijderd worden",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>
