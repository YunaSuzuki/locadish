<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
            'image' => 'required',
            'country' => 'required',
        ]);
        
        if ($request->has('image')){
        
        #formから送信されたimageファイルを読み込む
        $file = $request->file('image');
        
        #s3に追加
        $path = Storage::disk('s3')->putFile('/', $file, 'public');
        #画像のURLを参照
        $url = Storage::disk('s3')->url($path);
        

        $request->user()->posts()->create([
            'content' => $request->content,
            'image' => $path,
            'country' => $request->country
        ]);
        
        return back();
            
        }
        
        
    }
    
    public function destroy($id)
    {
        $post = \App\Post::find($id);

        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }

        return back();
    }
    
}
