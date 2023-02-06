<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{


    public function index()
    {
        $orders = Order::query()
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }


    public function add(Request $request)
    {
        $userOrders = Order::where('user_id', Auth::id())->where('completed', false)->count();
        if ($userOrders >= 1) {
            return response()->json([
                'success' => false,
                'data' => 'Please wait to finish previous order'
            ]);
        }
        $card = Card::find($request['card_id']);
        $user = Auth::user();

        if ($user->coins > $card->coins) {
            $user->coins = $user->coins - $card->coins;
            $user->save();
            $order = new Order();
            $order->name = $request['name'];
            $order->user_id = Auth::id();
            $order->card_id = $request['card_id'];
            $order->save();
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'can not completed this order'
            ]);
        }
        return response()->json([
            'success' => true,
            'coins' => Auth::user()->coins
        ]);
    }

    public function cards()
    {
        $cards = Card::query()->where('hide', false)->orderBy('name')->get();
        $cards->each(function ($item) {
            $item->image = asset($item->image ?? 'images/class.png');
        });
        return response()->json([
            'success' => true,
            'data' => $cards
        ]);
    }
}
