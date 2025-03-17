<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleComponent extends Component
{
    public $roles, $permissions, $name, $role_id, $selectedPermissions = [];

    public $isEdit = false;

    protected $rules = [
        'name' => 'required|unique:roles,name',
        'selectedPermissions' => 'required',
    ];

    public function mount()
    {
        $this->roles = Role::orderBy('id', 'DESC')->get();
        $this->permissions = Permission::all();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('success', 'Role Added successfully');
        $this->resetInputFields();
        $this->mount(); // Refresh data
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions()->pluck('id')->toArray();
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'selectedPermissions' => 'required',
        ]);

        $role = Role::find($this->role_id);
        $role->name = $this->name;
        $role->save();
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('success', 'Role updated successfully');
        $this->resetInputFields();
        $this->mount();
    }

    public function delete($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        session()->flash('success', 'Role deleted successfully');
        $this->mount();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->role_id = null;
        $this->selectedPermissions = [];
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.role-component');
    }
}
