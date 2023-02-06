<?php

namespace App\Http\Livewire\Alerts;

use Livewire\Component;

class Alerts extends Component
{
    public function render()
    {
        return view('livewire.alerts.alerts')->extends('layouts.admin')
            ->section('content');
    }
}
