<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetUsersInfoController extends Controller
{
    public function getTopThree()
    {
        return User::query()
            ->orderBy('coins', 'desc')
            ->select(['name', 'coins', 'count', 'blocked',])
            ->take(3)
            ->get();
    }

    public function getUserInfo()
    {
        try {
            $user = User::find(Auth::id());
            $rankingUsers = User::query()->orderByDesc('coins')->get();
            $position = $rankingUsers->search(function ($user) {
                    return $user->id == Auth::id();
                }) + 1;
            $top = $this->getTopThree();
            $cards = Card::query()->where('hide', false)->orderBy('name')->get();
            $cards->each(function ($item) {
                $item->image = $item->image ?? 'images/class.png';
            });
            $orders = Order::query()->whereBelongsTo(Auth::user())->orderByDesc('id')->take(3)->get();
            return response()->json([
                'success' => true,
                'data' => [
                    "name" => $user->name,
                    "email" => $user->email,
                    "coins" => $user->coins,
                    "flash" => $user->flash,
                    "diamond" => $user->diamond,
                    "level" => $user->level,
                    "count" => $user->count,
                    "blocked" => $user->blocked,
                    "rank" => $position,
                    "dailycount" => strtotime($user->dailycount->utc()) * 1000,
                    "dailycoins" => strtotime($user->dailycoins->utc()) * 1000,
                    "free" => $user->dailycoins->utc() < now(),
                    "freeVideos" => $user->dailycount->utc() < now(),
                ],
                'top' => $top,
                'cards' => $cards,
                'orders' => $orders,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msg' => 'Something going wrong !',
            ]);
        }

    }

}
