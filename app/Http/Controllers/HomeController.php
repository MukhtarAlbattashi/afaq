<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function classes()
    {
        return view('classes');
    }

    public function post($id)
    {
        return view('post', [
            'post' => Post::where('id',$id)->where('active', true)->firstOrFail()
        ]);

    }
    public function lesson($id)
    {
        return view('lesson', [
            'lesson' => Lesson::where('id', $id)->where('active', true)->firstOrFail()
        ]);
    }
}