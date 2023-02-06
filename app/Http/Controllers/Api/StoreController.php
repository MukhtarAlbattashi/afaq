<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class StoreController extends Controller
{
    public function buyProduct(Request $request)
    {
        try{
            $id = $request["id"] - 1;
            $products = $this->products();
            $user = Auth::user();
            if($user->coins >= $products[$id]['price']){
                $user->increment('diamond', $products[$id]['count']);
                $user->decrement('coins', $products[$id]['price']);
                $user->save();
                $this->addGame($products[$id]['count']);
            }else{
                return response()->json([
                    'success' => false,
                    'data' => Auth::user(),
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => Auth::user(),
            ]);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'data' => Auth::user(),
            ]);
        }
    }

    public function getStoreProduct()
    {
        return response()->json([
            'success' => true,
            'data' => $this->products(),
        ]);
    }

    public function addGame($count){
        $game = new Game();
        $game->name = 'Diamond';
        $game->user_id = Auth::id();
        $game->coins = $count;
        $game->next_game = now();
        $game->save();
    }

    private function products()
    {
        return [
            [
                'id' => 1,
                'type' => 'diamond',
                'price' => 5000,
                'count' => 1
            ],
            [
                'id' => 2,
                'type' => 'diamond',
                'price' => 24000,
                'count' => 5
            ],
            [
                'id' => 3,
                'type' => 'diamond',
                'price' => 49000,
                'count' => 10
            ],
            [
                'id' => 4,
                'type' => 'flash',
                'price' => 5000,
                'count' => 1
            ],
            [
                'id' => 5,
                'type' => 'flash',
                'price' => 24000,
                'count' => 5
            ],
            [
                'id' => 6,
                'type' => 'flash',
                'price' => 49000,
                'count' => 10
            ],
        ];
    }

}
