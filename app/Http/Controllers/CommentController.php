<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
	    $comments = Comment::all();
	    return response()->json([
		    'comments' => $comments,
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
			'body'        => 'required|max:255',

		]);
		$comment = Comment::create([
			'body'        => request('body'),
			'post_id'        => request('post_id'),
			'user_id'        => request('user_id'),
		]);
		return response()->json([
			'comment'    => $comment,
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
	public function update(Request $request, Comment $comment)
	{

		$this->validate($request, [
			'body'        => 'required|max:255',
			'post_id' => 'required',
			'user_id' => 'required',
		]);
		$comment->body = request('body');
		$comment->post_id = request('post_id');
		$comment->user_id = request('user_id');
		$comment->save();

		return response()->json([
			'message' => 'Comment updated successfully!'
		], 200);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Comment $comment)
	{
		$comment->delete();

		return response()->json([
			'message' => 'Comment deleted successfully!'
		], 200);
	}
}
