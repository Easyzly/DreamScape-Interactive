<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $roleId = 0;

    public function render()
    {
        $roles = Role::all();

        $users = User::query();

        $users->where(function($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        });

        if ($this->roleId && $this->roleId != 0) {
            $users->whereHas('roles', function($query) {
                $query->where('role_id', $this->roleId);
            });
        }

        return view('livewire.users-table', [
            'users' => $users->paginate($this->perPage),
            'roles' => $roles
        ]);
    }
}
