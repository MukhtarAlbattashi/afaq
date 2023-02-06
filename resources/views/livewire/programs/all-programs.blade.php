<div>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-md-3">
                <br>
                <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                    <ol class="breadcrumb fw-bold">
                        <li class="breadcrumb-item">
                            <span class="fas fa-home"></span> <span>الرئيسية</span>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="fst-italic text-main">البرامج</span>
                        </li>
                    </ol>
                </nav>

                <div>
                    <input class="form-control" wire:model.debounce.500ms="search" type="text" placeholder="بحث">
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="text-center">جميع البرامج</h2>
                <div class="row">
                    @forelse($apps as $app)
                    <div class="col-lg-3 col-sm-12 col-md-6">
                        <div class="card mt-4 shadow border-1">
                            <div class="card-body p-2 text-center rounded" :class="localStorage.theme == 'dark' ? 'dark-card' : ''">
                                <img src="{{ asset($app->image ?? 'images/open_source.jpg') }}" alt="image" class="app-icon">
                                <p class="card-title fw-bold mt-2 text-center">{{$app->name}}</p>
                                <div class="p-1 text-center">
                                    <div class="watch m-2">
                                        <a href="{{$app->url}}" target="_blank" class="text-decoration-none badge light-green btn-sm btn-rounded text-white b-0">
                                            تحميل
                                            <span class="fas fa-download mx-1"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center mt-5 text-main fw-bold">لا توجد نتائج</p>
                    @endforelse
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="d-flex justify-content-center">
                    {{ $apps->links() }}
                </div>
            </div>
        </div>
    </div>
</div>