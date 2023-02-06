<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.home.home')->extends('layouts.public')
        ->section('content');
    }
}
