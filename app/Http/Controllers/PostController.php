<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        return view('post.index',[
            'categories' => Category::all(),
            'posts' => auth()->user()->posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {         
                 
        $request->validate([
            'title' => ['string', 'min:3'],
            'content' => ['string', 'min:10']
        ]);
       
        //$path = Storage::put('images', $request->file('image'));
        //dd($path);        
        
        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,   
            'category_id' => $request->category_id,   
        ]);

        if($request->image)  
        {          
            $request->image->store('images', 'public');            
            $post->update(['image' => $request->image->hashName()]);
        }
        return redirect('/posts/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($request->id);        
        $post->update([
            'title' => $request->title,
            'content' => $request->content,            
        ]);
        
        if($request->image)  
        {          
            $request->image->store('images', 'public');            
            $post->update(['image' => $request->image->hashName()]);
        }

        return redirect('/posts/index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {               
        Post::find($request->id)->delete();
        return redirect('/posts/index');
    }
}
