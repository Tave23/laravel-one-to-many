@extends('layouts.app')

@section('content')
<div class="container">
      <div class="justify-content-center">
         {{-- nome utente loggato --}}
         <h2>Ciao {{ Auth::user()->name }}, edita il post numero {{ $post->id }}</h2>

         @if ($errors->any())
            <div class="alert alert-danger" role="alert">
               <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
         @endif

         {{-- per farel'update va aggiunta l'action (a update) con il metodo put e il @csrf --}}
         <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="mt-5">
            @csrf
            @method('PUT')

            {{-- input title --}}
            <div class="mb-3">
               <label for="title_post" class="form-label">Titolo Post</label>
               <input type="text" name="title_post" 
               class="form-control @error('title_post') is-invalid @enderror"
               id="title_post" placeholder="Inserisci il titolo..." 
               value="{{ old('title_post',$post->title_post) }}">

               {{-- messaggio di errore sotto il form --}}
               @error('title_post')
                     <p style="color: red">
                        {{ $message }}!
                     </p>
               @enderror
            </div>

            {{-- input content --}}
            <div class="mb-3">
               <label for="content" class="form-label">Contenuto del Post</label>
               <textarea type="text" name="content" 
               class="form-control @error('content') is-invalid @enderror"
               id="content" placeholder="Inserisci il contenuto del post..." 
               style="height: 200px">{{ old('content',$post->content) }}</textarea>

               {{-- messaggio di errore sotto il form --}}
               @error('content')
                  <p style="color: red">
                     {{ $message }}!
                  </p>
              @enderror
            </div>

            {{-- bottoni salva e reset --}}
            <button type="submit" class="btn btn-success">Salva Post</button>
            <button type="reset" class="btn btn-danger">Reset Post</button>
          </form>
         
      </div>
</div>
@endsection

{{-- titolo scheda pagina --}}
@section('title_page')
   Edit Post
@endsection