<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\carbon;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if((Auth::user()->role->role)== "admin"){
            $posts = Post::paginate();
        } elseif ((Auth::user()->role->role)== "writer") {
            $posts = Post::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(1);
        }
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags= Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $request->validate([
            'title'=>'required|min:5|max:100',
            'body'=>'required|min:5|max:500 ',
            'img' => 'image'
        ]);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'], '-');
        $newPost = new Post();

        if(!empty($data['path_img'])){
            $data['path_img'] = Storage::disk('public')->put('images',$data['path_img']);
        }

        $newPost->fill($data);

        $saved = $newPost->save();

        $newPost->tags()->attach($data['tags']);

        if($saved){
            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $users = User::all();
        // $id = $post['user_id'];
        // $user = $users->find($id);
        // $nomeUtente = $user['name'];
        // $tags = $post['tags'];
        // return view('admin.posts.show', compact('post','nomeUtente','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('admin.posts.edit',compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data= $request->all(); //array di dati
        $data['slug']= str::slug($data['title'], '-');
        //aggiorna la data
        $data['updated_at'] = Carbon::now();
        // inserire il validate
        //istruzione update sql
        // $post->save(); //istruzione salva la sql
        if(!empty($data['tags'])){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }
        $post->update($data);
        return redirect()->route('posts.index')->with('status','Hai modificato il post! Id ' . $post->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status','Hai cancellato il post! Id ' . $post->id);
    }
}
