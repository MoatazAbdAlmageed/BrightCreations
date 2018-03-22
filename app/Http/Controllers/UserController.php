<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function edit( User $user ) {
		$user    = Auth::user();
		$hobbies = Hobby::All();

		return view( 'auth.edit', compact( 'user', 'hobbies' ) );
	}

	public function update( User $user ) {

		$this->validate( request(), [
			'name'     => 'required',
			'email'    => 'required',
			'password' => 'required|min:6|confirmed'
		] );

		$user->name     = request( 'name' );
		$user->email    = request( 'email' );
		$user->gender   = request( 'gender' );
		$user->password = bcrypt( request( 'password' ) );


		$avatar = request()->file( 'avatar' );


		if ( $avatar ) {

			$upload       = 'img/avatar';
			$filename     = $avatar->getClientOriginalName();
			$success      = $avatar->move( $upload, $filename );
			$user->avatar = $filename;

		}


		if ( $user->save() ) {

			/* handle user hobbies */

			/* remove  user hobbies  from user_hobbies table */

			DB::table( 'user_hobbies' )->where( 'user_id', Auth::user()->id )->delete();


			/* get  user hobbies  from request */

			if ( request( 'hobby' ) ) {
				foreach ( request( 'hobby' ) as $hobby ) {
					$values = array( 'hobby_id' => $hobby, 'user_id' => Auth::user()->id );
					DB::table( 'user_hobbies' )->insert( $values );

				}
			}
		}


		/* add  user hobbies  to  user_hobbies table */

		return back();
	}
}