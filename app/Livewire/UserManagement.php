<?php


namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagement extends Component
{
    use WithPagination;

    public $name, $email, $password, $role, $userId;
    public $search = '';
    public $isEditMode = false;
    public $roles = [];
    public $selectedRoles = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'selectedRoles' => 'required|array',
    ];

    public function mount()
    {
        $this->roles = Role::pluck('name', 'name')->all();
    }

    public function clearSearch()
{
    $this->search = '';
}

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.user-management', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditMode = true;
    }


    public function resetInputFields()
    {
        $this->reset(['name', 'email', 'password', 'selectedRoles', 'userId']);
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->selectedRoles);

        $this->resetInputFields();
        session()->flash('message', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('name')->toArray();
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->userId),
            ],
            'password' => 'nullable|string|min:8',
            'selectedRoles' => 'required|array',
        ]);

        $user = User::find($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();
        $user->syncRoles($this->selectedRoles);

        $this->resetInputFields();
        session()->flash('message', 'User updated successfully.');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }
}
