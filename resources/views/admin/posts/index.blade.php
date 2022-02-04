@extends('layouts.app')

@section('content')
<div class="container">
      <div class="justify-content-center">
         <h2 class="text-left">Ciao {{ $loggedUser->name}}! Ecco l'elenco dei post</h2>

         {{-- post eliminato --}}
         @if (session('deleted_post'))
            <div class="alert alert-success" role="alert">
               {{ session('deleted_post') }}
            </div>
         @endif


         <table class="table my-3">
               <thead>
               <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Titolo del post</th>
                  <th scope="col">Contenuto del post</th>
                  <th scope="col">Slug</th>
                  <th scope="col" colspan="3"></th>
               </tr>
               </thead>

               <tbody>

               @foreach ($posts as $post)
                  
                  <tr>
                     <th scope="row">{{ $post->id }}</th>
                     <td>{{ $post->title_post }}</td>
                     <td>{{ $post->content }}</td>
                     <td>{{ $post->slug }}</td>
                     <td>
                        <a href="{{ route('admin.posts.show', $post) }}" type="button" class="btn btn-success ">
                           Show
                        </a>
                     </td>
                     <td>
                        <a href="{{route('admin.posts.edit', $post) }}" type="button" class="btn btn-warning">
                           Edit
                        </a>
                     </td>
                     <td>
                        
                        {{-- per la funzione delete bisogna NECESSARIAMENTE usare il form con il @method DELETE e @csrf --}}
                        <form onsubmit="return confirm('Sicuro di voler eliminare {{ $post->title }}')" 
                           action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                           @csrf
                           @method('DELETE')

                           <button type="submit" type="button" class="btn btn-danger">Delete</button>

                        </form>

                     </td>
                  </tr>

               @endforeach
               
               </tbody>
            </table>
           
            {{$posts->links()}}
      </div>
</div>
@endsection

@section('title_page')
   Posts List
@endsection