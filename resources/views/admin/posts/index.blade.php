@extends('layouts.app')
@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Autore</th>
              <th scope="col">Titolo</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
                 <th scope="row">{{$post->id}}</th>
                 <td><a href="{{ route('guest.posts.show', $post->id) }}">{{ $post->user->name }}</a></td>
                 <td><a href="{{ route('guest.posts.show', $post->id) }}">{{ $post->title }}</a></td>
                 <td><a href="{{ route('posts.edit', $post->id) }}">Edit</a></td>
                 <td>
                     <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                         @csrf
                         @method('DELETE')
                         <button type="submit" name="button" class="btn btn-primary">Cancella</button>
                     </form>
                 </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-5 justify-content-center">
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>
@endsection
