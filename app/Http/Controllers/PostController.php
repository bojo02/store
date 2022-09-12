<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select('*')->orderBy('created_at', 'desc')->paginate(12);

        $categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return strtolower($slug);
     }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required',
            'body' => 'required',
            'category_id' => 'required',

        ]);

           $file = $request->file('photo');
    
           $name = $request->file('photo')->getClientOriginalName();
    
           $path = $request->file('photo')->storeAs('/images', $name);
    
           $request->file('photo')->move(public_path('images'), $name);
    
           $photo = new Photo;
    
           $photo->name = $name;
           $photo->path = $path;
    
           $photo->save();

        $post = new Post();
        $post->title = $request->title;
        $post->photo = $photo->id;
        $post->slug = $this->create_slug($request->title);
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;

        $post->save();

        return view('pages.post.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('slug', $id)->first();

        return view('pages.post.show', compact('post'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
