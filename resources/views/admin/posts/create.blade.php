 @extends('layouts.app')
 @section('content')
     <form action="{{ route('posts.store') }}" method="post">
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
