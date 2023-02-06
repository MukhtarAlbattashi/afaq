<div>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card mb-3">
                <div class="card-header bg-light text-primary font-weight-bold">
                    <h6>
                        All Apps
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
                                            {{$apps->total()}}
                                        </div>
                                        <div class="text-muted  text-uppercase font-weight-bold small">
                                            {{__('Total Apps')}}
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
                                    <input class="form-control" wire:model.debounce.500ms="search" type="text" placeholder="Search">
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table bg-light table-striped table-responsive-sm table-bordered text-center">
                                <thead class="text-primary font-weight-bold">
                                    <tr>
                                        <th>Name</th>
                                        <th>url</th>
                                        <th>Image</th>
                                        <th>tools</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($apps as $app)
                                    <tr wire:key="row-{{$app->id}}">
                                        <td>{{$app->name}}</td>
                                        <td>
                                            <a href="{{$app->url}}" target="_blank">
                                                <span class="badge rounded-pill bg-info text-white">
                                                    {{$app->url}}
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <img src="{{asset($app->image ?? 'images/class.png')}}" height="40" width="40" alt="">
                                        </td>
                                        <td>
                                            <a wire:click="dublicate({{$app->id}})">
                                                <i class=" fas fa-clipboard text-dark"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No Data Available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="card-footer p-3 align-items-center justify-content-center">
                    {{ $apps->links() }}
                </div>
            </div>
        </div>
    </div>


    <script>


    </script>

</div>