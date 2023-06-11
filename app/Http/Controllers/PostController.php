<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate();
        return view('post.index',compact('posts'));
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
            'name'=>'required|max:200',
            'image'=>'required|image'
        ]);

        $post = new Post();
        $post->name = $request->name;
        if($request->has('image')){
            $file_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('image',$file_name);
            $post->image = $file_name;
        }
        $post->save();
        return response()->json(['message'=>'Post Created successfully!']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()->json(['data'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name'=>'required|max:200',
            'image'=>'nullable|image'
        ]);

        $post->name = $request->name;
        if($request->has('image')){
            $file_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('image',$file_name);
            $post->image = $file_name;
        }
        $post->save();
        return response()->json(['message'=>'Post updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success','Post deleted successfully!');
    }
}
