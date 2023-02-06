<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public array $roles = ['editor', 'user'];
    public $username, $email, $password, $role, $editUsername, $editEmail, $editPassword, $blocked, $editCoins, $user_id;
    public $topUser, $unActiveUsers, $newUsers, $newUsersMonthly;
    public string $search = '';
    protected string $paginationTheme = 'bootstrap';
    protected $rules = [
        'username' => 'required|min:3|max:60',
        'email' => 'required|min:3|max:30|unique:users',
        'password' => 'required|min:6|max:10',
    ];

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function mount()
    {
        $this->authorize('isAdmin');
        $this->role = $this->roles[1];
    }

    public function render()
    {
        return view('livewire.users.users', [
            'users' => User::mySearch($this->search)->orderBy('coins', 'desc')->paginate(15),
            $this->topUser = User::query()->orderBy('coins', 'desc')->first(),
            $this->unActiveUsers = User::query()->where('coins', 0)->count(),
            $this->newUsers = User::query()->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count(),
            $this->newUsersMonthly = User::query()->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->count()
        ])->extends('layouts.app')
            ->section('content');
    }

    // Save New User
    public function create()
    {
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function editUser($id)
    {
        $this->user_id = $id;
        $user = User::find($this->user_id);
        $this->editUsername = $user->name;
        $this->editEmail = $user->email;
        $this->blocked = $user->blocked;
        $this->editCoins = $user->coins;
        $this->dispatchBrowserEvent('show-edit-model');
    }
    //End save new user

    //edit user

    public function updateUser()
    {
        $validatedData = $this->validate(
            [
                'editUsername' => 'required|min:3|max:60',
                'editEmail' => 'required|min:3|max:60'
            ],
        );
        $user = User::find($this->user_id);
        $user->name = $this->editUsername;
        if ($this->editPassword != null && Str::length($this->editPassword) > 6) {
            $user->password = Hash::make($this->editPassword);
        }
        $user->blocked = $this->blocked;
        $user->coins = $this->editCoins;
        $user->save();
        session()->flash('update', 'User Updated!');
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->user_id = null;
    }

    public function save()
    {
        $this->validate();
        $user = new User();
        $user->name = $this->username;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = Hash::make($this->password);
        $user->email_verified_at = now();
        $user->save();
        $this->reset();
        $this->dispatchBrowserEvent('hide-create-model');
        session()->flash('success', 'User Added Successfully!');
    }
    //End edit user

    //Delete User

    public function remove($id)
    {
        $this->user_id = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function deleteUser()
    {
        User::find($this->user_id)->delete();
        session()->flash('success', 'User Removed');
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->user_id = null;
    }
    //End Delete User
}
