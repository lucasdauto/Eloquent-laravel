<?php

namespace App\Http\Controllers;

use App\Post;
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
//        echo "Listagem de arquivos";

//        $posts = Post::where('created_at','>=',date('Y-m-d H:i:s'))->orderBy('title','desc')->take(2)->get();
//        foreach ($posts as $post){
//            echo "<h1>{$post->title}</h1>";
//            echo "<h2>{$post->subtitle}</h2>";
//            echo "<p>{$post->description}</p>";
//            echo"<hr>";
//        }

//        $post = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->first();
//        echo "<h1>{$post->title}</h1>";
//        echo "<h2>{$post->subtitle}</h2>";
//        echo "<p>{$post->description}</p>";
//        echo "<hr>";
//
//        $post = Post::where('created_at', '>=', date('2020-m-d H:i:s'))->firstOrFail();
//        echo "<h1>{$post->title}</h1>";
//        echo "<h2>{$post->subtitle}</h2>";
//        echo "<p>{$post->description}</p>";
//        echo "<hr>";

//        $post =  Post::find(1);
//        echo "<h1>{$post->title}</h1>";
//        echo "<h2>{$post->subtitle}</h2>";
//        echo "<p>{$post->description}</p>";
//        echo "<hr>";

        // max - min - sum - count - avg
//        $posts = Post::where('created_at','>=',date('Y-m-d H:i:s'))->orderBy('title','desc')->take(2)->count();
//        foreach ($posts as $post){
//            echo "<h1>{$post->title}</h1>";
//            echo "<h2>{$post->subtitle}</h2>";
//            echo "<p>{$post->description}</p>";
//            echo"<hr>";
//        }

        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $postRequest = [
//            'title' => $request->title,
//            'subtitle' => $request->subtitle,
//            'descrition' => $request->description
//        ];

        //Object -> Prop -> Save
//        $post =  new Post();
//        $post->title = $request->title;
//        $post->subtitle = $request->subtitle;
//        $post->description = $request->description;
//        $post->save();

//        Post::create([
//            'title' => $request->title,
//            'subtitle' => $request->subtitle,
//            'description' => $request->description,
//        ]);

//        $post = Post::firstOrNew(
//            [
//                'title' => $request->title
//            ],
//            [
//                'subtitle' => $request->subtitle
//            ],
//            [
//                'description' => $request->description
//            ]);


//        var_dump($post);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->description = $request->description;
        $post->save();

//        $post = Post::updateOrCreate([
//            'title' => 'teste5'
//        ],[
//            'subtitle' => 'teste5',
//            'description' => 'teste5',
//        ]);

//        $posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->update(['description' => 'teste']);


        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//        Post::find($post->id)->delete();
//        Post::destroy([21,20]);
        Post::destroy($post->id);

//        var_dump($post);
        return redirect()->route('posts.index');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view('trashed', ["posts" => $posts]);
    }

    public function restore($post)
    {
        $post = Post::onlyTrashed()->where(['id' => $post])->first();

        if ($post->trashed()) {
            $post->restore();
        }

        return redirect()->route('posts.trashed');
    }

    public function forceDelete($post)
    {
        Post::onlyTrashed()->where(['id' => $post])->forceDelete();

        return redirect()->route('posts.trashed');
    }
}
