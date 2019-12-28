<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FavoriteController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return back();
    }
    
    public function favorite_post($id)
    {
        $user = User::find($id);
        
        $posts = $user->favorite_post()->paginate(10);

        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        
        $data += $this->counts($user);

        return view('posts.favorite_posts', $data);
        
    }
}
