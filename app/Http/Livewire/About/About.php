<?php

namespace App\Http\Livewire\About;

use App\Models\Post;
use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class About extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.about.about')->extends('layouts.post')
        ->section('content');
    }
}
