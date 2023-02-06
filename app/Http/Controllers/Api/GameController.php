<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{


    public function acceptGame(Request $request)
    {
        $lastGame = Game::query()->where('user_id', Auth::id())->latest()->first();
        if ($lastGame == null) {
            $this->createGame($request);
            $game = Game::where('user_id', Auth::id())
                ->where('name', $request['game_name'])
                ->latest()->first();
            return response()->json([
                'success' => true,
                'coins' => Auth::user()->coins,
                'data' => $game
            ]);
        }
        if ($lastGame->name != $request['game_name'] || $lastGame->next_game < now()) {
            $this->createGame($request);
            $game = Game::where('user_id', Auth::id())
                ->where('name', $request['game_name'])
                ->latest()->first();
            return response()->json([
                'success' => true,
                'coins' => Auth::user()->coins,
                'data' => $game
            ]);
        }
        return response()->json([
            'success' => false,
            'msg' => 'Error'
        ]);
    }

    private function createGame(Request $request): void
    {
        $game = new Game();
        $game->name = $request['game_name'];
        $game->user_id = Auth::id();
        $game->coins = $request['coins'];
        $game->next_game = now()->addDay()->utc();
        $game->save();
        $user = Auth::user();
        $user->increment('coins', $request['coins']);
        $user->save();
    }

    public function getGameState(Request $request)
    {
        $game = Game::where('user_id', Auth::id())
            ->where('name', $request['game_name'])
            ->latest()->first();

        if ($game == null) {
            return response()->json([
                'success' => true
            ]);
        }

        if ($game->next_game > now()) {
            return response()->json([
                'success' => false,
                'data' => $game,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $game,
        ]);
    }

}
