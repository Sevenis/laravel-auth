@extends('layouts.app')
@section('content')

    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
             <th scope="row">{{$post->id}}</th>
             <td>{{$post->title}}</td>
             <td><a href="{{ route('posts.edit', $post->id) }}">Edit</a></td>
             <td>
                 <form class="{{ route('posts.destroy', $post->id) }}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" name="button" class="btn btn-primary">Cancella</button>
                 </form>
             </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection
