<div>
    <div class="row mt-5">
        <div class="col-md-3">
            <aside>
                <div class="card">
                    <div class="card-header bg-opacity-10">
                        <h5 class="text-white">
                            المحتويات
                        </h5>
                    </div>
                    <div class="card-body rounded" :class="localStorage.theme == 'dark' ? 'dark-card' : 'bg-light'">
                        {!! $menu !!}
                    </div>
                </div>
                <br>
                <livewire:posts.recent-posts />
            </aside>
        </div>
        <div class="col-md-9">
            @markdomStyles($theme)
            <article>
                <div class="main-img" style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('{{ asset($post->image) }}')">
                    <h1 class="text-white text-center p-2 main-title w-100">
                        {{$post->title}}
                    </h1>
                </div>
                <div class="author  mt-2">
                    <div class="user-info">
                        <span class="user-name badge back-green-light p-2" :class="localStorage.theme == 'dark' ? 'text-main' : ''">
                            Admin
                        </span>
                    </div>
                    <div class="social-media">
                        <span class="badge back-green-light p-2" :class="localStorage.theme == 'dark' ? 'text-main' : ''">
                            {{$post->created_at->diffForHumans()}}
                        </span>
                    </div>
                </div>
                <div class="mt-5">
                    {!! $content !!}
                </div>
            </article>
        </div>
    </div>
</div>