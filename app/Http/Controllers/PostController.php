<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{

  public function index() {

      $posts = Post::all();

      return view('guest.home',compact('posts'));

  }

  public function show($id) {

      $post = Post::where('user_id',Auth::id());

      return view('guest.show',compact('post'));

  }
}
