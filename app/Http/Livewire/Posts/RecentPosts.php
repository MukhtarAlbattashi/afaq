<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class RecentPosts extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $tags = Post::query()->pluck('tags');
        $temp = [];
        foreach ($tags as $tag) {
            array_push($temp, $tag);
        }
        $unique_array = array_unique($temp, SORT_REGULAR);
        $temp = implode(',', $unique_array);
        $tags = explode(',', $temp);
        $tags = array_unique($tags, SORT_REGULAR);
        return view('livewire.posts.recent-posts', [
            'posts' => Post::query()
                ->where('active', true)
                ->orderBy('created_at', 'desc')
                ->take(5)->get(),
            'tags' => $tags,
        ])->extends('layouts.post')
            ->section('content');
    }
}
