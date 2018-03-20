<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
//	    $categories = Category::all();

	    $categories = Category::withCount('posts')->get();


	    return response()->json([
		    'categories' => $categories,
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

	    ]);

	    $category = Category::create([
		    'title'        => request('title'),
	    ]);

	    return response()->json([
		    'category'    => $category,
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
	public function update(Request $request, Category $category)
    {
	    $this->validate($request, [
		    'title'        => 'required|max:255',

	    ]);

	    $category->title = request('title');

	    $category->save();

	    return response()->json([
		    'message' => 'Category updated successfully!'
	    ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Category $category)
	{
		$category->delete();

		return response()->json([
			'message' => 'Category deleted successfully!'
		], 200);
	}
}
