<?php

use App\Http\Livewire\About\About;
use App\Http\Livewire\Games\ShowGames;
use App\Http\Livewire\Home\Home;
use App\Http\Livewire\Orders\NewOrders;
use App\Http\Livewire\Orders\ShowOrders;
use App\Http\Livewire\Plans\AddPlan;
use App\Http\Livewire\Posts\AddPost;
use App\Http\Livewire\Posts\AllPosts;
use App\Http\Livewire\Posts\PostDetails;
use App\Http\Livewire\Posts\ShowPosts;
use App\Http\Livewire\Programs\AddProgram;
use App\Http\Livewire\Programs\AllPrograms;
use App\Http\Livewire\Programs\ShowPrograms;
use App\Http\Livewire\Settings\Settings;
use App\Http\Livewire\Users\Users;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'super-admin'], function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
});

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('super-admin')->middleware(['auth', 'isAdminOrEditor'])->group(function () {

    Route::get('/users', Users::class)->name('users');
    Route::get('/plans', AddPlan::class)->name('plans');

    Route::get('/show-games', ShowGames::class)->name('games');

    Route::get('/new-orders', NewOrders::class)->name('new-orders');
    Route::get('/all-orders', ShowOrders::class)->name('all-orders');

    Route::get('/show-programs', ShowPrograms::class)->name('show-programs');
    Route::get('/add-program', AddProgram::class)->name('add-program');

    Route::get('/show-posts', ShowPosts::class)->name('show-posts');
    Route::get('/add-post', AddPost::class)->name('add-post');

    Route::get('/settings', Settings::class)->name('settings');
});

Route::get('/posts/{post}', PostDetails::class)->name('post-details');
Route::get('/posts', AllPosts::class)->name('posts');

Route::get('/about', About::class)->name('about');

Route::get('/home', Home::class)->name('home');

Route::get('/applications', AllPrograms::class)->name('programs');