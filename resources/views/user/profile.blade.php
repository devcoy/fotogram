@extends('layouts.app')

@section('content')
<div class="container">
  <div class="data-user row justify-content-left align-items-center mt-3 mb-5">
    <div class="img-profile col-4 col-md-3">
      @if($user->image)
      <img src="{{ route('user.image', array('filename' => $user->image)) }}" alt="{{ $user->nick }}" class="">
      @endif
    </div>
    <div class="col-8 col-md-9">
      <h2> {{ '@' . $user->nick }}</h2>
      <h4>{{ $user->name . ' ' . $user->surname}}</h4>
      <small>{{'Miembro desde ' .  \FormatTime::LongTimeFilter($user->created_at) }}</small><br/>
      <small>{{ count($user->images) . ' Publicaciones' }}</small>
    </div>    
  </div>

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