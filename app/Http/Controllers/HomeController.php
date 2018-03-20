<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function get_counters()
	{
		$posts = Post::all();
		$comments = Comment::all();
		$categories = Category::all();
		return response()->json([
			'posts' => count($posts),
			'comments' => count($comments),
			'categories' => count($categories),
		], 200);
	}
}
