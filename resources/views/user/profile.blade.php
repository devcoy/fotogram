@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Publicaciones de {{ $user->name . $user->surname }}</h1>
  @include ('includes.message')
  <div class="row justify-content-left">    
    @if($user->images && count($user->images) > 0)
    @foreach($user->images as $image)
    <div class="col-md-6">
      @include('includes.single-image', array('image' => $image))
    </div>
    @endforeach
    @else
    <p class="text-center">No hay imágenes para mostrar</p>
    @endif
  </div>

  <!-- paginación -->
  <div class="clear-fix"> </div>
</div>
@endsection