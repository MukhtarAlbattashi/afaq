<?php

namespace App\Http\Livewire\Programs;

use App\Models\Post;
use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class AllPrograms extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.programs.all-programs',[
            'apps' => Program::mySearch($this->search)
                ->paginate(18),
        ])->extends('layouts.post')
        ->section('content');
    }
}
