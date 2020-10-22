 @extends('layouts.app')
 @section('content')
     //Gestione errori
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
     @endif


     <form action="{{ route('posts.update' , $post->id) }}" method="post">
      @csrf
      @method('POST')
       <div class="form-group">
         <label for="title">Titolo</label>
         <input type="text" name="title" class="form-control" aria-describedby="Inserisci il titolo" placeholder="Titolo post">
       </div>
       <div class="form-group">
         <label for="body">Testo</label>
         <textarea class="form-control" name="body" rows="3"></textarea>
       </div>
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
 @endsection
