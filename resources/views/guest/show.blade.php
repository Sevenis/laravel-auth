 @extends('layouts.app')
 @section('content')

    <div class="container d-flex align-items-center flex-column">
        <div class="card m-3 card-show">
            <div class="card-img">
                {{-- oppure asset('storage/').$post->img per il percorso dell'immagine --}}
                {{-- <img src=" {{ asset('storage/').$post->path_img }} " class="img-fluid card-img-top" alt="{{$post->title}}"> --}}
                <img src=" {{ Storage::url($post->path_img) }} " class="img-fluid card-img-top" alt="{{$post->title}}">
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title text-center text-uppercase text-info">{{$post->title}}</h4>
            <h5 class="card-title text-center text-uppercase text-info">Autore: {{$post->user->name}}</h4>
            <p class="card-text"> {{$post->body}} </p>
            <p class="card-text">Tags: @foreach ($post->tags as $tag){{$tag->name}} @endforeach</p>
        </div>

        <div class="flex text-center">
              <a class="btn btn-info" href="{{route('posts.index')}}">I tuoi Post</a>
        </div>
    </div>
 @endsection
