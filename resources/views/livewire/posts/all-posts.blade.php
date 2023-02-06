<div>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-md-3">
                <br>
                <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" dir="rtl">
                    <ol class="breadcrumb fw-bold">
                        <li class="breadcrumb-item">
                            <span class="fas fa-home"></span> <span>الرئيسية</span>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="fst-italic text-main">المقالات</span>
                        </li>
                    </ol>
                </nav>
                <input class="form-control" wire:model.debounce.500ms="search" type="text" placeholder="بحث">
                <br>
                <livewire:posts.recent-posts />
            </div>
            <div class="col-md-9">
                <h2 class="text-center"> المقالات</h2>
                @forelse($posts as $post)
                <div class="col-md-12">
                    <div class="card mt-4 shadow border-1">
                        <div class="card-body rounded" :class="localStorage.theme == 'dark' ? 'dark-card' : ''">
                            <h5 class="card-title fw-bold mt-2 text-center text-main">{{$post->title}}</h5>
                            <p class="card-subtitle mb-2 text-mute p-2 text-justify">
                                {{Illuminate\Support\Str::limit($post->preview,500)}}
                            </p>
                            <div class="d-flex justify-content-between m-1">
                                <a href="{{route('post-details',$post)}}" class="text-decoration-none badge light-green btn-sm btn-rounded text-white b-0">
                                    المزيد
                                    <span class="fas fa-chevron-left mx-1"></span>
                                </a>
                                <span class="badge back-green-light p-2" :class="localStorage.theme == 'dark' ? 'text-main' : ''">
                                    {{$post->created_at->diffForHumans()}}
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center mt-5 text-main fw-bold">لا توجد نتائج</p>
                @endforelse
                <div class="col-md-12 mt-3">
                    <div class="d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>