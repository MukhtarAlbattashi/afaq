<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public bool $show = true;
    public string $lastupdate = ' ';
    public int $published, $draft = 0;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->authorize('isAdminOrEditor');
        $this->getState();
    }

    public function render()
    {
        return view('livewire.posts.show-posts', [
            'posts' => Post::mySearch($this->search)
                ->orderBy('created_at', 'desc')
                ->paginate(9),
        ])->extends('layouts.app')
            ->section('content');
    }

    public function changeStatus($id)
    {
        $post = Post::query()->where('id', $id)->first();
        $post->active = !$post->active;
        $post->save();
        $this->getState();
        session()->flash('update', 'تم الحفظ');
        $this->dispatchBrowserEvent('show-alert');
    }

    public function delete($id)
    {
        Post::query()->where('id', $id)->delete();
        $this->getState();
        session()->flash('success', 'تم الحذف');
        $this->dispatchBrowserEvent('show-alert');
    }

    private function getState()
    {
        $this->lastupdate = Post::query()->orderBy('updated_at', 'DESC')->first()->updated_at->diffForHumans();
        $this->published = Post::query()->where('active', 1)->count();
        $this->draft = Post::query()->where('active', 0)->count();
    }
}
