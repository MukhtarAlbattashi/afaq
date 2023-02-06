<?php

namespace App\Http\Livewire\Cards;

use App\Models\Card;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCard extends Component
{
    use WithFileUploads;

    public $name, $coins;
    public $available = false;
    public $photo;
    protected $rules = [
        'name' => 'required|min:5|max:200',
        'coins' => 'required|numeric',
        'photo' => 'image ',
    ];

    public function render()
    {
        return view('livewire.cards.add-card')->extends('layouts.app')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        $card = new Card();
        $card->name = $this->name;
        $card->coins = $this->coins;
        $card->available = $this->available;
        $path = $this->photo->store('photos', 'public');
        $card->image = 'storage/' . $path;
        $card->save();
        session()->flash('success', 'Card Added Successfully!');
    }
}
