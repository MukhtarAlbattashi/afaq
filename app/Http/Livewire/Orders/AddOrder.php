<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddOrder extends Component
{
    public $name, $message;
    public $completed = false;

    protected $rules = [
        'name' => 'required|min:5|max:200'
    ];

    public function render()
    {
        return view('livewire.orders.add-order')->extends('layouts.app')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        $order = new Order();
        $order->name = $this->name;
        $order->user_id = Auth::id();
        $order->message = $this->message;
        $order->completed = $this->completed;
        $order->save();
        session()->flash('success', 'تم حفظ الطلب بنجاح !');
    }
}
