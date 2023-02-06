<div>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card mb-3">
                <div class="card-header bg-light text-primary font-weight-bold d-flex justify-content-between">
                    <h6>
                        All Posts
                    </h6>
                    <h6 class="text-info">
                        {{$lastupdate}}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-gray-50 mb-2">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fas  fa-file bg-primary p-3 font-2xl m-1 text-white rounded"></i>
                                    <div>
                                        <div class="text-value-sm text-info">
                                            {{$posts->total()}}
                                        </div>
                                        <div class="text-muted  text-uppercase font-weight-bold small">
                                            {{__('Total Posts')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-gray-50 mb-2">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fas fa-file bg-success p-3 font-2xl m-1 text-white rounded"></i>
                                    <div>
                                        <div class="text-value-sm text-info">
                                            {{$published}}
                                        </div>
                                        <div class="text-muted  text-uppercase font-weight-bold small">
                                            {{__('Publishd Posts')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-gray-50 mb-2">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fas  fa-file bg-warning p-3 font-2xl m-1 text-white rounded"></i>
                                    <div>
                                        <div class="text-value-sm text-info">
                                            {{$draft}}
                                        </div>
                                        <div class="text-muted  text-uppercase font-weight-bold small">
                                            {{__('Draft')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>
                                    <input class="form-control" wire:model.debounce.500ms="search" type="text" placeholder="Search">
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 text-end" dir="rtl">
                            @include('livewire.alerts.alerts')
                        </div>


                        <div class="col-md-12">
                            <table class="table bg-light table-striped  table-bordered text-center">
                                <thead class="text-primary font-weight-bold">
                                    <tr>
                                        <th>Name</th>
                                        <th>active</th>
                                        <th>tools</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($posts as $post)
                                    <tr wire:key="post-row-{{$post->id}}">
                                        <td>{{$post->title}}</td>
                                        <td>
                                            <a wire:click="changeStatus({{$post->id}})" @class(['badge', 'bg-info text-white'=> $post->active, 'bg-warning text-primary'=> !$post->active])>
                                                {{$post->active?'active':'not active'}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('post-details',$post)}}" target="_blank">
                                                <i class=" fas fa-eye text-primary"></i>
                                            </a>
                                            <a wire:click="delete({{$post->id}})">
                                                <i class=" fas fa-trash text-danger"></i>
                                            </a>
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
                <div class="card-footer p-3 align-items-center justify-content-center d-flex">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('show-alert', event => {
            setTimeout(function() {
                var element = document.getElementById("alert");
                element.style.display = "none";
            }, 1500);
        })
    </script>

</div>