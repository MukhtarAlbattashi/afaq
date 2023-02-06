<?php

namespace App\Http\Livewire\Cards;

use App\Models\Card;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCards extends Component
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
        return view('livewire.cards.show-cards', [
            'cards' => Card::mySearch($this->search)
                ->orderBy('created_at', 'desc')
                ->paginate(5),
        ])->extends('layouts.app')
            ->section('content');
    }


    public function orderCompletion($id, $state)
    {
        $card = Card::find($id);
        $card->available = $state;
        $card->save();
    }

    public function hideShow($id, $state)
    {
        $card = Card::find($id);
        $card->hide = $state;
        $card->save();
    }

    public function remove($id)
    {
        $this->cardId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function deleteCard()
    {
        Card::find($this->cardId)->delete();
        session()->flash('success', 'card deleted successfully');
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->cardId = null;
    }

    public function changePrice($id)
    {
        $this->cardId = $id;
        $card = Card::find($this->cardId);
        $this->price = $card->coins;
        $this->card_name = $card->name;
        $this->dispatchBrowserEvent('show-message-model');
    }

    public function changeCardPrice()
    {
        $card = Card::find($this->cardId);
        $card->coins = $this->price;
        $card->name = $this->card_name;
        $card->save();
        session()->flash('update', 'card updated successfully');
        $this->dispatchBrowserEvent('hide-message-model');
        $this->cardId = null;
    }
}
