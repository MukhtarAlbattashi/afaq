<?php

namespace App\Http\Livewire\Orders;

use App\Models\Comment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class NewOrders extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $draft, $activate, $orderId, $message, $changedmessage;
    public $search = '';
    public $active;
    public $paginate = 35;
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];
    protected $paginationTheme = 'bootstrap';

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize('isAdminOrEditor');
        $this->counters();
    }

    public function counters()
    {
        $this->activate = Order::where('completed', '=', true)->count();
    }

    public function render()
    {
        return view('livewire.orders.new-orders', [
            'orders' => Order::query()->with(['user', 'card'])
                ->mySearch($this->search)
                ->where('card_id', '!=', null)
                ->where('completed', false)
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
        $this->selected = $value ? Order::query()->mySearch(trim($this->search))
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
                $selectedAllIndex = Order::query()->mySearch(trim($this->search))
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
            $this->selectAll ? Order::mySearch(trim($this->search))
                ->orderBy('created_at', 'desc')->delete() : Order::whereKey($this->selected)->delete();
            $this->selectPage = false;
            session()->flash('success', 'Games Deleted Successfully');
        } else {
            session()->flash('error', 'Select at least one game!');
        }
    }


    public function makeRefund($id, $user_id)
    {
        $order = Order::query()->find($id);
        $order->message = 'can not complete this order';
        $order->completed = true;
        $order->decline = true;
        $user = User::query()->find($user_id);
        $user->coins = $user->coins + $order->card->coins;
        $user->save();
        $order->save();
        session()->flash('success', 'order updated successfully');
    }

    public function changeMessage($id)
    {
        $this->orderId = $id;
        $order = Order::find($this->orderId);
        $this->changedmessage = $order->message;
        $this->dispatchBrowserEvent('show-message-model');
    }

    public function changeMessageToUser()
    {

        $Order = Order::find($this->orderId);
        $Order->message = $this->changedmessage;
        $Order->save();
        session()->flash('update', 'order updated successfully');
        $this->dispatchBrowserEvent('hide-message-model');
        $this->orderId = null;
    }


    public function orderState($id, $state)
    {
        $order = Order::find($id);
        $order->decline = $state;
        $order->save();
        $this->counters();
        session()->flash('update', 'order updated successfully');
    }

    public function orderToComplete($id, $state)
    {
        $order = Order::find($id);
        $order->completed = $state;
        $order->save();
        $this->counters();
        session()->flash('update', 'order updated successfully');
    }

    public function remove($id)
    {
        $this->orderId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function deleteOrder()
    {
        Order::find($this->orderId)->delete();
        session()->flash('success', 'order deleted successfully');
        $this->counters();
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->orderId = null;
    }
}
