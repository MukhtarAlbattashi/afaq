<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.posts.all-posts',[
            'posts' => Post::mySearch($this->search)
            ->where('active',true)
                ->orderBy('created_at', 'desc')
                ->paginate(12),
        ])->extends('layouts.post')
        ->section('content');
    }
}
