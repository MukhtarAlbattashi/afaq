<div>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header bg-light text-primary font-weight-bold">
                <h6><i class="fas fa-table mr-2"></i> {{ __('New Orders Table') }}</h6>
            </div>
            <div class="card-body">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-4">
                        <div class="card bg-gray-50 mb-3">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fas fa-cart-shopping bg-info p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-info">
                                        {{$orders->total()}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('total orders')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-gray-50 mb-3">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fas fa-cart-shopping bg-secondary p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-secondary">
                                        {{$orders->total() - $activate}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('uncompleted orders')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-gray-50 mb-3">
                            <div class="card-body p-3 d-flex align-items-center">
                                <i class="fas fa-cart-shopping bg-success p-3 font-2xl m-1 text-white rounded"></i>
                                <div>
                                    <div class="text-value-sm text-success">
                                        {{$activate}}
                                    </div>
                                    <div class="text-muted  text-uppercase font-weight-bold small">
                                        {{__('completed orders')}}
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
                                                class="badge rounded bg-gray-100 text-info px-2">{{$orders->count()}}</strong> items.
                                            Do you want Select All ?
                                        </span>

                                        <button wire:click="selectAll"
                                                class="badge rounded bg-gray-100 text-info border-0 px-2">
                                            Select All! <strong>{{$orders->total()}} items</strong>
                                        </button>
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <span><strong>{{$orders->total()}}</strong> items selected</span>
                                    </div>
                                @endunless
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <table
                            class="table bg-light table-hover table-striped table-responsive-sm table-bordered text-center">
                            <thead class="text-primary font-weight-bold">
                            <tr>
                                <th>
                                    @if ($orders->count() > 0)
                                        <input type="checkbox" wire:model="selectPage" class="m-0 p-0">
                                    @endif
                                </th>
                                <th>User / Coins</th>
                                <th>User Status</th>
                                <th>Message</th>
                                <th>Card / Coins</th>
                                <th>Available</th>
                                <th>Send Time</th>
                                <th>Completed</th>
                                <th>Order Status</th>
                                <th>Settings</th>
                            </tr>
                            </thead>

                            <tbody class="fw-bolder">
                            @forelse ($orders as $order)
                                <tr wire:key="order-row-{{$order->id}}">
                                    <td>
                                        <input type="checkbox" wire:model="selected" value="{{$order->id}}"
                                               class="m-0 p-0">
                                    </td>
                                    <td>{{$order->user->email}} <br>
                                        <span class="badge bg-warning rounded text-primary">
                                                {{$order->user->coins}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($order->user->blocked)
                                            <span class="badge rounded bg-secondary text-white">
                                                not active
                                            </span>
                                        @else
                                            <span class="badge rounded bg-success text-white">
                                                 active
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span @class(['badge rounded bg-warning text-primary' => $order->message == null])>
                                            {{$order->message ?? 'Empty'}}
                                        </span>
                                    </td>
                                    <td>{{$order->card->name}} <br>
                                        <span class="badge bg-warning rounded text-primary">
                                                {{$order->card->coins}}
                                        </span>
                                    </td>
                                    <td>
                                        @if(!$order->card->available)
                                            <span class="badge rounded bg-secondary text-white">
                                                not available
                                            </span>
                                        @else
                                            <span class="badge rounded bg-success text-white">
                                                 available
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span>{{$order->created_at->diffForHumans()}}</span>
                                    </td>
                                    <td>
                                        @if($order->completed)
                                            <a class="badge rounded bg-secondary text-white"
                                               wire:click="orderToComplete({{$order->id}}, {{0}})">
                                                <span>
                                                    disable
                                                </span>
                                            </a>
                                        @else
                                            <a class="badge rounded bg-success text-white"
                                               wire:click="orderToComplete({{$order->id}}, {{1}})">
                                                <span>
                                                    enable
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->decline)
                                            <a class="badge rounded bg-danger text-white"
                                               wire:click="orderState({{$order->id}}, {{0}})">
                                                <span>
                                                    decline
                                                </span>
                                            </a>
                                        @else
                                            <a class="badge rounded bg-info text-white"
                                               wire:click="orderState({{$order->id}}, {{1}})">
                                                <span>
                                                    normal
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-link dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    id="dropdownMenuButton1">
                                                <i class="fas fa-cogs"></i>
                                            </button>
                                            <ul class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton1">
                                                @if (!$order->card->available)
                                                    <li class="d-grid gap-1 m-1">
                                                        <a class="btn btn-success btn-sm text-white"
                                                           wire:click="makeRefund({{$order->id}}, {{$order->user->id}})">
                                                            Refund
                                                            <i class="fas fa-user m-1">

                                                            </i>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li class="d-grid gap-1 m-1">
                                                    <a class="btn btn-warning btn-sm"
                                                       wire:click="changeMessage({{$order->id}})"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#editModal">
                                                        Change Message
                                                        <i class="fas fa-message m-1">

                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="d-grid gap-1 m-1">
                                                    <a class="btn btn-danger btn-sm"
                                                       wire:click="remove({{$order->id}})" data-bs-toggle="modal"
                                                       data-bs-target="#dangerModal">
                                                        Delete
                                                        <i class="fas fa-trash m-1">

                                                        </i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11">No Data</td>
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
                        {{ $orders->links() }}
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
                            Delete Order
                        </h4>
                        <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                    </div>
                    <div class="modal-body">
                        You are going to delete this Order <strong class="text-danger">forever.</strong> click delete
                        to
                        continue!
                    </div>
                    <div class="modal-footer justify-content-center w-100">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger text-white" wire:click="deleteOrder" type="button">Delete
                        </button>
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
                            Update Order
                        </h4>
                        <button class="btn btn-outline-light text-white" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" class="fas fa-times"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-envelope"></i></span></div>
                                            <textarea class="form-control" wire:model.defer="changedmessage"
                                                      id="message" type="text" name="message" placeholder="الرسالة"
                                                      rows="3"></textarea>
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
                        <button class="btn btn-info text-white" wire:click="changeMessageToUser" type="button">Save
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
    window.addEventListener('show-edit-model', event => {
        $('#editModal').modal('show');
    })
    window.addEventListener('hide-edit-model', event => {
        $('#editModal').modal('hide');
    })
</script>
