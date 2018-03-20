<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	protected $fillable = [ 'user_id', 'category_id', 'title', 'description' ];

	protected $with = ['category'];

//	protected $with = ['comment'];

	public function user() {
		return $this->belongsTo( User::class );
	}

	public function category() {
		return $this->belongsTo( Category::class );

	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

}
