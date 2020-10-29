 @extends('layouts.app')
 @section('content')
     {{-- //Gestione errori --}}
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
     @endif

 <div class="container center">
     {{-- enctype ti permette l'upload dei file --}}
     <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('POST')
       <div class="form-group">
         <label for="title">Titolo</label>
         <input type="text" name="title" class="form-control" aria-describedby="Inserisci il titolo" placeholder="Titolo post">
       </div>
       <div class="form-group">
           {{-- accept="image/*" significa che accetta img di qualsiasi formato --}}
         <label for="body">Immagine</label>
         <input type="file" name="path_img" accept="image/*">
       </div>
       <div class="form-group">
         <label for="img">Testo</label>
         <textarea class="form-control" name="body" rows="3"></textarea>
       </div>
       <div class="form-group">
           @foreach ($tags as $tag)
               <label for="tag">{{ $tag -> name }}</label>
               <input type="checkbox" name="tags[]" value=" {{ $tag-> id}}">
           @endforeach
       </div>
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
 </div>
 @endsection
