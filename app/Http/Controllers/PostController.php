<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->sortDesc();
        //dd($posts);
        return view('index', compact("posts"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //$posts = Post::all();
        $posts = Post::paginate(2);
        return view('post.list', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $post=new Post();
        $post->title=$request->input('title');
        $post->content=$request->input('content');

        $file = $request->file('inputFile'); //obtenemos el campo file definido en el formulario
        $nombre = "images/noticias/".$file->getClientOriginalName();//obtenemos el nombre del archivo
        $nombre_file = "noticias/".$file->getClientOriginalName();

        $post->image=$nombre;

        \Storage::disk('local')->put($nombre_file,  \File::get($file));//indicamos que queremos guardar un nuevo archivo en el disco local

        $post->save();
        return redirect()->route('post.list');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $file = $request->file('inputFile'); //obtenemos el campo file definido en el formulario
        if($file != null){ //si cambiaron la imagen, elimino la anterior y la guardo

            $delete = Str::of($post->image)->substr(6);
            \Storage::disk('local')->delete($delete);

            $nombre = "images/noticias/".$file->getClientOriginalName();//obtenemos el nombre del archivo
            $post->image=$nombre;
            $nombre_file = "noticias/".$file->getClientOriginalName();
            \Storage::disk('local')->put($nombre_file,  \File::get($file));
        }

        $post->save();
        return redirect()->route('post.edit',[$post])
                         ->with('message','Post Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $delete = Str::of($post->image)->substr(6);
        \Storage::disk('local')->delete($delete);

        $post->delete();
        return redirect()->route('post.list');
    }
}
