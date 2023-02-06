<div>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card mb-3">
                <div class="card-header bg-light text-primary font-weight-bold">
                    <h6>
                        All Cards
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-gray-50 mb-2">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fas  fa-calendar bg-primary p-3 font-2xl m-1 text-white rounded"></i>
                                    <div>
                                        <div class="text-value-sm text-info">
                                            {{$cards->total()}}
                                        </div>
                                        <div class="text-muted  text-uppercase font-weight-bold small">
                                            {{__('Total Cards')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            @include('livewire.alerts.alerts')
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>
                                    <input class="form-control" wire:model.debounce.500ms="search" type="text"
                                           placeholder="Search">
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table
                                class="table bg-light table-striped table-responsive-sm table-bordered text-center">
                                <thead class="text-primary font-weight-bold">
                                <tr>
                                    <th>Name</th>
                                    <th>Coins</th>
                                    <th>Image</th>
                                    <th>Available</th>
                                    <th>Status</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($cards as $card)
                                    <tr wire:key="subject-row-{{$card->id}}">
                                        <td>{{$card->name}}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-warning text-primary">
                                                {{$card->coins}}
                                            </span>
                                        </td>
                                        <td>
                                            <img src="{{asset($card->image ?? 'images/class.png')}}" height="40"
                                                 width="40" alt="">
                                        </td>
                                        <td>
                                            <i @class([
                                                    'fas fa-circle-check text-success' => $card->available,
                                                    'fas fa-circle-xmark text-danger' => !$card->available])></i>
                                        </td>
                                        <td>
                                            <i @class([
                                                    'fas fa-eye-slash text-warning' => $card->hide,
                                                    'fas fa-eye text-info' => !$card->hide])></i>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                @if ($card->hide)
                                                    <button class="btn btn-sm btn-outline-info"
                                                            wire:click="hideShow({{$card->id}},{{0}})">
                                                        <span class="fas fa-eye"></span>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-warning"
                                                            wire:click="hideShow({{$card->id}},{{1}})">
                                                        <span class="fas fa-eye-slash"></span>
                                                    </button>
                                                @endif
                                                @if (!$card->available)
                                                    <button class="btn btn-sm btn-outline-success "
                                                            wire:click="orderCompletion({{$card->id}},{{1}})">
                                                        <span class="fas fa-circle-check"></span>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary"
                                                            wire:click="orderCompletion({{$card->id}},{{0}})">
                                                        <span class="fas fa-times-circle"></span>
                                                    </button>

                                                @endif
                                                <button class="btn btn-sm btn-outline-info"
                                                        wire:click="changePrice({{$card->id}})" data-bs-toggle="modal"
                                                        data-bs-target="#editMessageModal">
                                                    <span class="fas fa-edit"></span>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger"
                                                        wire:click="remove({{$card->id}})" data-bs-toggle="modal"
                                                        data-bs-target="#dangerModal">
                                                    <span class="fas fa-trash"></span>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Data Available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="card-footer p-3 align-items-center justify-content-center">
                    {{ $cards->links() }}
                </div>
            </div>

            <div wire:ignore.self class="modal fade" id="dangerModal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center bg-danger">
                            <h4 class="modal-title w-100 text-white">
                                Delete Card
                            </h4>
                            <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                        </div>
                        <div class="modal-body">
                            You are going to delete this Card <strong class="text-danger">forever.</strong> click delete
                            to
                            continue!
                        </div>
                        <div class="modal-footer justify-content-center w-100">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger text-white" wire:click="deleteCard" type="button">Delete
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content-->
                </div>
                <!-- /.modal-dialog-->
            </div>

            <div wire:ignore.self class="modal fade" id="editMessageModal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-light modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center bg-info">
                            <h4 class="modal-title w-100 text-white">
                                Update Card
                            </h4>
                            <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><span class="input-group-text"><i
                                                            class="fa fa-envelope"></i></span></div>
                                                <label for="card_name"></label>
                                                <input class="form-control" wire:model.defer="card_name" id="card_name"
                                                       type="text" name="card_name">
                                            </div>
                                            @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><span class="input-group-text"><i
                                                            class="fa fa-envelope"></i></span></div>
                                                <label for="message"></label><input class="form-control"
                                                                                    wire:model.defer="price"
                                                                                    id="message"
                                                                                    type="text" name="message">
                                            </div>
                                            @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer  justify-content-center w-100">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-info text-white" wire:click="changeCardPrice" type="button">Save
                            </button>
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

        window.addEventListener('show-message-model', event => {
            $('#editMessageModal').modal('show');
        })
        window.addEventListener('hide-message-model', event => {
            $('#editMessageModal').modal('hide');
        })
    </script>

</div>



