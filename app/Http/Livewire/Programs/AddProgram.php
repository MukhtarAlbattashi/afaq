<?php

namespace App\Http\Livewire\Programs;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProgram extends Component
{
    use WithFileUploads;

    public $name, $url;
    public $photo;
    protected $rules = [
        'name' => 'required|min:5|max:200',
        'url' => 'required',
        'photo' => 'image ',
    ];

    public function render()
    {
        return view('livewire.programs.add-program')->extends('layouts.app')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        $card = new Program();
        $card->name = $this->name;
        $card->url = $this->url;
        $path = $this->photo->store('photos', 'public');
        $card->image = 'storage/' . $path;
        $card->save();
        session()->flash('success', 'تم الحفظ!');
        $this->dispatchBrowserEvent('show-alert');
        $this->reset();
    }
}
