<?php

namespace App\Http\Livewire\Games;

use App\Models\Comment;
use App\Models\Game;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ShowGames extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $draft, $activate, $gameId;
    public $search = '';
    public $active;
    public $paginate = 35;
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->authorize('isAdminOrEditor');
    }

    public function render()
    {
        return view('livewire.games.show-games', [
            'games' => Game::with('user')->mySearch(trim($this->search))
                ->orderBy('created_at', 'desc')
                ->paginate($this->paginate),
        ])->extends('layouts.app')
            ->section('content');
    }

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        $this->selected = $value ? Game::mySearch(trim($this->search))
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate)
            ->pluck('id')
            ->map(function ($id) {
                return (string)$id;
            }) : [];
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function exportAll()
    {
        if (count($this->selected) > 0) {
            if ($this->selectAll) {
                $selectedAllIndex = Game::mySearch(trim($this->search))
                    ->orderBy('created_at', 'desc')
                    ->pluck('id')
                    ->map(function ($id) {
                        return (string)$id;
                    });
            }
        } else {
            session()->flash('error', 'Select One Game at least');
        }
    }

    public function deleteAll()
    {
        if (count($this->selected) > 0) {
            $this->selectAll ? Game::mySearch(trim($this->search))
                ->orderBy('created_at', 'desc')->delete() : Game::whereKey($this->selected)->delete();
            $this->selectPage = false;
            session()->flash('success', 'Games Deleted Successfully');
        } else {
            session()->flash('error', 'Select at least one game!');
        }
    }

    public function remove($id)
    {
        $this->gameId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function deleteGame()
    {
        Game::find($this->gameId)->delete();
        session()->flash('success', 'Game Deleted Successfully!');
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->gameId = null;
    }
}
