<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoinController extends Controller
{

    public function daily()
    {
        $user = Auth::user();
        if ($user->dailycoins > now()) {
            return response()->json([
                'success' => false,
                'date' => (strtotime(Auth::user()->dailycoins->utc()) * 1000),
                'coins' => Auth::user()->coins,
                'free' => $user->dailycoins->utc() < now(),
            ]);
        }
        $game = new Game();
        $game->name = 'daily coins';
        $game->user_id = Auth::id();
        $game->coins = 5;
        $game->next_game = now()->addDay();
        $game->save();
        $user->dailycoins = now()->addDay();
        $user->increment('coins', 5);
        $user->save();
        return response()->json([
            'success' => true,
            'date' => (strtotime(Auth::user()->dailycoins->utc()) * 1000) - 10000,
            'coins' => Auth::user()->coins,
            'free' => $user->dailycoins->utc() < now(),
        ]);
    }

    public function adsCoins()
    {
        $user = Auth::user();

        if ($user->dailycount < now()) {
            $this->addCoins($user);
            return response()->json([
                'success' => true,
                'coins' => Auth::user()->coins,
                'count' => Auth::user()->count,
                'date' => (strtotime(Auth::user()->dailycount->utc()) * 1000) - 3000,
            ]);
        }
        return response()->json([
            'success' => false,
            'coins' => Auth::user()->coins,
            'count' => Auth::user()->count,
            'date' => (strtotime(Auth::user()->dailycount->utc()) * 1000) - 3000,
        ]);
    }


    public function addCoins($user)
    {
        $coins = [5, 10, 15, 20, 25];
        $user->increment('coins', $coins[$user->count]);
        if ($user->count >= 4) {
            $user->dailycount = now()->addDay();
            $user->count = -1;
            $user->save();
        }
        $user->count++;
        $user->save();
        $game = new Game();
        $game->name = 'videos coins';
        $game->user_id = Auth::id();
        $game->coins = $coins[$user->count];
        $game->next_game = now();
        $game->save();
    }


    public function hint()
    {
        $user = Auth::user();
        if ($user->coins >= 10) {
            $user->decrement('coins', 10);
            $user->save();
            return response()->json([
                'success' => true,
                'coins' => Auth::user()->coins
            ]);
        }
        return response()->json([
            'success' => false,
            'coins' => Auth::user()->coins
        ]);
    }
}
