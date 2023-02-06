<div>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header bg-light text-primary font-weight-bold">
                <h6><i class="fas fa-table mr-2"></i> {{ __('Games Table') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-gray-50 mb-3">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fab fa-playstation bg-info p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-info">
                                        {{$games->total()}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('total games')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @include('livewire.alerts.alerts')
                    </div>

                    <div class="container-fluid">
                        <div class="row justify-content-between m-0 p-0 mb-3">
                            <div class="col-md-4 p-0">
                                <div class="form-group">
                                    <input class="form-control" autocomplete="off" wire:model="search" type="text"
                                           placeholder="Search ... ">
                                </div>
                            </div>
                            <div class="col-md-4 text-end p-0">
                                <button class="btn btn-outline-danger" wire:click="deleteAll" type="button"><i
                                        class="fas fa-trash"></i>
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if ($selectPage)
                            <div class="col-md-12 m-3">
                                @unless ($selectAll)
                                    <div class="text-lowercase fs-5">
                                        <span>You Select <strong
                                                class="badge rounded bg-gray-100 text-info px-2">{{$games->count()}}</strong> items.
                                            Do you want Select All ?
                                        </span>

                                        <button wire:click="selectAll"
                                                class="badge rounded bg-gray-100 text-info border-0 px-2">
                                            Select All! <strong>{{$games->total()}} items</strong>
                                        </button>
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <span><strong>{{$games->total()}}</strong> items selected</span>
                                    </div>
                                @endunless
                            </div>
                        @endif
                    </div>

                    <div class="container-fluid">
                        <table
                            class="table bg-light table-striped table-bordered text-center">
                            <thead class="text-primary font-weight-bold">
                            <tr>
                                <th>
                                    @if ($games->count() > 0)
                                        <input type="checkbox" wire:model="selectPage" class="m-0 p-0">
                                    @endif
                                </th>
                                <th>Game Name</th>
                                <th>Email</th>
                                <th>Coins</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Next Game</th>
                                <th>Time Difference</th>
                                <th>Setting</th>
                            </tr>
                            </thead>

                            <tbody class="fw-bolder">
                            @forelse ($games as $game)
                                <tr wire:key="game-row-{{$game->id}}">
                                    <td>
                                        <input type="checkbox" wire:model="selected" value="{{$game->id}}"
                                               class="m-0 p-0">
                                    </td>
                                    <td>
                                        <h2 @class([
                                            'badge rounded-pill bg-info' => $game->name == 'math-plus'||
                                                                            $game->name == 'math-minus'||
                                                                            $game->name =='math-multi'||
                                                                            $game->name =='math-division',
                                            'badge rounded-pill bg-warning text-primary' =>
                                                                            $game->name == 'videos coins' ||
                                                                            $game->name =='daily coins',]) style="font-size: 10pt">
                                            {{$game->name}}
                                        </h2>
                                    </td>
                                    <td>{{$game->user->email}}</td>
                                    <td>
                                        @if($game->coins > 0)
                                            <span
                                                class="badge rounded-pill bg-info px-3 py-1">{{$game->coins}}</span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-secondary text-white">{{$game->coins}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($game->coins > 0)
                                            <i class="fas  fa-circle-check text-success"></i>
                                        @else
                                            <i class="fas  fa-circle-xmark text-danger"></i>
                                        @endif
                                    </td>
                                    <td><span>{{$game->created_at}}</span></td>
                                    <td><span>{{$game->next_game}}</span></td>
                                    <td><span>{{ $game->next_game->diffForHumans($game->created_at)}}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-light text-danger"
                                                wire:click="remove({{$game->id}})" data-bs-toggle="modal"
                                                data-bs-target="#dangerModal"
                                                wire:loading.attr="disabled">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Data</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class=" align-items-center justify-content-between row">
                    <div class="col-md-6">
                        {{ $games->links() }}
                    </div>
                    <div class="col-md-2">
                        <select wire:model="paginate" name="paginate" id="paginate"
                                class="form-select" aria-label="Default select example">
                            <option value="10">Rows 10</option>
                            <option value="15">Rows 15</option>
                            <option value="20">Rows 20</option>
                            <option value="25">Rows 25</option>
                            <option value="30">Rows 30</option>
                            <option value="35">Rows 35</option>
                            <option value="40">Rows 40</option>
                            <option value="45">Rows45</option>
                            <option value="50">Rows 50</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="dangerModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center bg-danger">
                        <h4 class="modal-title w-100 text-white">
                            Delete Game
                        </h4>
                        <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                    </div>
                    <div class="modal-body">
                        You are going to delete this game <strong class="text-danger">forever.</strong> click delete to
                        continue!
                    </div>
                    <div class="modal-footer justify-content-center w-100">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger text-white" wire:click="deleteGame" type="button">Delete</button>
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
</script>
