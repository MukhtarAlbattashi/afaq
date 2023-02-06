<?php

namespace App\Http\Livewire\Programs;

use App\Models\Card;
use App\Models\Comment;
use App\Models\Program;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPrograms extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $draft, $activate, $cardId, $price, $card_name;
    public $search = '';
    public $active;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->authorize('isAdminOrEditor');
    }

    public function render()
    {
        return view('livewire.programs.show-programs', [
            'apps' => Program::mySearch($this->search)
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ])->extends('layouts.app')
            ->section('content');
    }

    public function dublicate($id)
    {
        $app = Program::query()->where('id', $id)->first()->replicate();
        $app->save();
        session()->flash('success', 'تم الحفظ!');
    }
}
