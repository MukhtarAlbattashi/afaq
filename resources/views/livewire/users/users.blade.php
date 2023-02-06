<div>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header bg-light text-primary font-weight-bold">
                <h6><i class="fas fa-table mr-2"></i> {{ __('Users Table') }}</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card bg-gray-50">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fa-solid fa-users bg-info p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-info">
                                        {{$users->total()}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('total users')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gray-50">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fa-solid fa-circle-arrow-down bg-danger p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-info">
                                        {{$unActiveUsers}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('inactive users')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gray-50">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fa-solid fa-circle-arrow-up bg-success p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-info">
                                        {{$newUsers}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('new users')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gray-50">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fa-solid fa-calendar bg-primary p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-info">
                                        {{$newUsersMonthly}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('monthly users')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-2">
                        @include('livewire.alerts.alerts')
                    </div>
                    <div class="container-fluid m-3">
                        <div class="row justify-content-between m-0 p-0">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" autocomplete="off" wire:model="search" type="text"
                                           placeholder="Search ... ">
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <button class="btn btn-success btn-sm text-white"
                                        data-bs-toggle="modal" data-bs-target="#createModal">
                                    New User
                                    <span class="fas fa-plus m-1">

                                        </span>
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <table
                            class="table bg-light table-striped table-bordered text-center">
                            <thead class="text-primary font-weight-bold">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Points</th>
                                <th>State</th>
                                <th>Last Login</th>
                                <th>Setting</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                            <span class="badge rounded-pill bg-warning text-primary">
                                                {{$user->coins}}
                                            </span>
                                    </td>
                                    @if ($user->blocked)
                                        <td><i class="fa-solid fa-circle-xmark text-danger"></i></td>
                                    @else
                                        <td><i class="fa-solid fa-circle-check text-success"></i></td>
                                    @endif
                                    <td>{{\Carbon\Carbon::parse($user->last)->diffForHumans()}}</td>
                                    <td>
                                        @unless ($user->role == 'admin')
                                            <button type="button" class="btn btn-light text-info"
                                                    wire:click="editUser({{$user->id}})"
                                                    wire:loading.attr="disabled" data-bs-toggle="modal"
                                                    data-bs-target="#editModal">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-light text-danger"
                                                    wire:click="remove({{$user->id}})" data-bs-toggle="modal"
                                                    data-bs-target="#dangerModal"
                                                    wire:loading.attr="disabled">
                                                Delete
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-light text-info"
                                                    wire:click="editUser({{$user->id}})"
                                                    wire:loading.attr="disabled" data-bs-toggle="modal"
                                                    data-bs-target="#editModal">
                                                Edit
                                            </button>
                                        @endunless
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No Data</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="crad-footer p-3 align-items-center justify-content-center">
                {{ $users->links() }}
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-light modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center bg-success">
                        <h4 class="modal-title w-100 text-white">
                            Register New User
                        </h4>
                        <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-user"></i></span></div>
                                            <input class="form-control" wire:model.defer="username" id="username"
                                                   type="text" name="username" placeholder="username" required>
                                        </div>
                                        @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-at"></i></span></div>
                                            <input class="form-control" wire:model.defer="email" id="email"
                                                   type="text" name="email" placeholder="Email"
                                                   required>
                                        </div>
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-unlock"></i></span></div>
                                            <input class="form-control" wire:model.defer="password" id="password"
                                                   type="password" name="password" placeholder="password"
                                                   required>
                                        </div>
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="dropdown">
                                            <select class="form-control" name="role" wire:model="role">
                                                @foreach ($roles as $key => $value)
                                                    <option value="{{ $value }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('role')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center w-100">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success text-white" wire:click="save" type="button">Add</button>
                    </div>
                </div>
                <!-- /.modal-content-->
            </div>
            <!-- /.modal-dialog-->
        </div>

        <div wire:ignore.self class="modal fade" id="dangerModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center bg-danger">
                        <h4 class="modal-title w-100 text-white">
                            Delete User
                        </h4>
                        <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                    </div>
                    <div class="modal-body">
                        You are going to delete this user <strong class="text-danger">forever.</strong> click delete to
                        continue!
                    </div>
                    <div class="modal-footer justify-content-center w-100">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger text-white" wire:click="deleteUser" type="button">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content-->
            </div>
            <!-- /.modal-dialog-->
        </div>

        <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-light modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center bg-info">
                        <h4 class="modal-title w-100 text-white">
                            Update User
                        </h4>
                        <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-user"></i></span></div>
                                            <input class="form-control" wire:model.defer="editUsername"
                                                   id="editUsername" type="text" name="editUsername"
                                                   placeholder="اسم المستخدم" required>
                                        </div>
                                        @error('editUsername')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-at"></i></span></div>
                                            <input class="form-control" wire:model.defer="editEmail" id="editEmail"
                                                   type="text" name="editEmail" placeholder="Email" disabled>
                                        </div>
                                        @error('editEmail')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-at"></i></span></div>
                                            <input class="form-control" wire:model.defer="editCoins" id="editCoins"
                                                   type="number" name="editCoins" placeholder="Coins">
                                        </div>
                                        @error('editCoins')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <div class="input-group">
                                            <div class="input-group-text"><span class="input-group-text"><i
                                                        class="fa fa-unlock"></i></span></div>
                                            <input class="form-control" wire:model.defer="editPassword"
                                                   id="editPassword" type="password" name="editPassword"
                                                   placeholder="password">
                                        </div>
                                        @error('editPassword')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" wire:model.defer="blocked" type="checkbox"
                                               id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Block</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer  justify-content-center w-100">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-info text-white" wire:click="updateUser" type="button">Save</button>
                    </div>
                </div>
                <!-- /.modal-content-->
            </div>
            <!-- /.modal-dialog-->
        </div>
    </div>
</div>


<script>
    window.addEventListener('show-delete-model', event => {
        $('#dangerModal').modal('show');
    })
    window.addEventListener('hide-delete-model', event => {
        $('#dangerModal').modal('hide');
    })
    window.addEventListener('show-edit-model', event => {
        $('#editModal').modal('show');
    })
    window.addEventListener('hide-edit-model', event => {
        $('#editModal').modal('hide');
    })
    window.addEventListener('show-create-model', event => {
        $('#createModal').modal('show');
    })
    window.addEventListener('hide-create-model', event => {
        $('#createModal').modal('hide');
    })
</script>
