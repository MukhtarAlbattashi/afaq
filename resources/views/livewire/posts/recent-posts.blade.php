<div>
    <div class="card-body p-0 rounded">
        <ul class="list-group">
            <li class="list-group-item bg-opacity-10">
                <h5 class="text-white">
                    آخر المقالات
                </h5>
            </li>
            @foreach($posts as $post)
            <a href="{{route('post-details',$post)}}" class="list-group-item list-group-item-action" :class="localStorage.theme == 'dark' ? 'dark-card' : 'bg-light'">
                {{$post->title}}
            </a>
            @endforeach
        </ul>
    </div>
    <br>
    <div>
        <ul class="card p-0">
            <div class="bg-opacity-10 card-header">
                <h5 class="text-white">
                    وسوم
                </h5>
            </div>
            <div class="card-body rounded" :class="localStorage.theme == 'dark' ? 'dark-card' : 'bg-light'">
                @foreach($tags as $tag)
                <span class="badge rounded-pill light-green text-white text-decoration-none m-1 px-3">{{$tag}}</span>
                @endforeach
            </div>
        </ul>
    </div>
</div>