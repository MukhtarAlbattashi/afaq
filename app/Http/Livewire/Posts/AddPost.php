<?php

namespace App\Http\Livewire\Posts;

use Livewire\WithFileUploads;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
class AddPost extends Component
{
    use WithFileUploads;

    public string $title, $tags, $preview = '';
    public string $markdown = '';
    public string $slug = '';
    public string $theme = 'default';
    public $photo;
    protected array $rules = [
        'title' => 'required|min:5|max:200',
        'preview' => 'required',
        'slug'=>'required|unique:posts',
        'markdown' => 'required',
    ];

    public function render()
    {
        return view('livewire.posts.add-post')->extends('layouts.app')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        $post = new Post();
        $post->title = $this->title;
        $post->tags= $this->tags;
        $post->slug = $this->slug;
        $post->preview = $this->preview;
        $post->body = $this->markdown;
        $path = $this->photo->store('photos', 'public');
        $post->image = 'storage/' . $path;
        $post->save();
        session()->flash('success', 'Post Added Successfully!');
    }

    public function updatedTheme($value)
    {
        $this->theme = $value;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value, '-', null);
    }
}
