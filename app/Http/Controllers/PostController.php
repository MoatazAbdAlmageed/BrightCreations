<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//	    $posts = request()->user()->posts;
	    $posts = Post::withCount('comments')->get();


	    return response()->json([
		    'posts' => $posts,
	    ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate($request, [
		    'title'        => 'required|max:255',
		    'description' => 'required',
		    'category_id' => 'required',
	    ]);

	    $post = Post::create([
		    'title'        => request('title'),
		    'description' => request('description'),
		    'user_id'     => Auth::user()->id,
		    'category_id'     => request('category_id'),
	    ]);

	    return response()->json([
		    'post'    => $post,
		    'message' => 'Success'
	    ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
	    $this->validate($request, [
		    'title'        => 'required|max:255',
		    'description' => 'required',
	    ]);

	    $post->title = request('title');
	    $post->category_id = request('category_id');
	    $post->description = request('description');
	    $post->save();

	    return response()->json([
		    'message' => 'Post updated successfully!'
	    ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




	public function destroy(Post $post)
	{
		$post->delete();

		return response()->json([
			'message' => 'Post deleted successfully!'
		], 200);
	}
}
