<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;

class RoleManagement extends Component
{
    public $roles;
    public $permissions;
    public $roleId;
    public $name;
    public $selectedPermissions = [];
    public $isEditMode = false;
    public $confirmingDelete = false;
    public $deleteRoleId, $deleteRoleName, $deletePermissions = [];

    protected $rules = [
        'name' => 'required|unique:roles,name',
        'selectedPermissions' => 'required|array',
        'selectedPermissions.*' => 'exists:permissions,id', // Validate each permission ID exists
    ];

    public function mount()
    {
        $this->roles = Role::orderBy('id', 'DESC')->get();
        $this->permissions = Permission::get();
    }

    public function render(): View
    {
        return view('livewire.role-management');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditMode = true;
    }

    public function store()
    {

        if (!$this->name) {
            session()->flash('error', 'Role name is required.');
            return;
        }

        if (empty($this->selectedPermissions)) {
            session()->flash('error', 'At least one permission must be selected.');
            return;
        }

        $this->validate();

        // Ensure all selected permissions exist
        $validPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        if (count($validPermissions) !== count($this->selectedPermissions)) {
            session()->flash('error', 'One or more selected permissions do not exist.');
            return;
        }

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($validPermissions);

        $this->resetInputFields();
        $this->roles = Role::orderBy('id', 'DESC')->get();

        session()->flash('message', 'Role Created Successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->name = $role->name;

        // Filter out invalid permissions
        $validPermissions = Permission::whereIn('id', $role->permissions->pluck('id'))->pluck('id')->toArray();
        $this->selectedPermissions = $validPermissions;

        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->roleId,
            'selectedPermissions' => 'required|array',
            'selectedPermissions.*' => 'exists:permissions,id', // Validate each permission ID exists
        ]);

        // Ensure all selected permissions exist
        $validPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        if (count($validPermissions) !== count($this->selectedPermissions)) {
            session()->flash('error', 'One or more selected permissions do not exist.');
            return;
        }

        $role = Role::find($this->roleId);
        $role->name = $this->name;
        $role->save();

        // Sync permissions
        $role->syncPermissions($validPermissions);

        $this->resetInputFields();
        $this->roles = Role::orderBy('id', 'DESC')->get();

        session()->flash('message', 'Role Updated Successfully.');
    }

    // public function delete($id)
    // {
    //     Role::find($id)->delete();
    //     $this->roles = Role::orderBy('id', 'DESC')->get();

    //     session()->flash('message', 'Role Deleted Successfully.');
    // }


    public function confirmDelete($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $this->deleteRoleId = $role->id;
        $this->deleteRoleName = $role->name;
        $this->deletePermissions = $role->permissions->pluck('name')->toArray();
    }
    public function delete()
    {
        Role::findOrFail($this->deleteRoleId)->delete();
        $this->roles = Role::orderBy('id', 'DESC')->get();
        session()->flash('message', 'Role deleted successfully.');
        $this->reset(['deleteRoleId', 'deleteRoleName', 'deletePermissions']);
    }


    private function resetInputFields()
    {
        $this->name = '';
        $this->selectedPermissions = [];
    }
}
