@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Usuarios</h1>
  <div class="user-search w-100 mt-3 mb-5">
    <form action="{{ route('user.index') }}" method="get" class="form-inline" id="search-form">
      <div class="form-group col-12 col-md-6">
        <input type="text" id="search" class="form-control w-100" placeholder="Buscar usuario...">
      </div>
      <div class="form-group col-12 col-md-6">
      <input type="submit" value="Buscar" class="btn btn-success btn-sm">
      </div>      
    </form>
  </div>
  <hr>
  <div class="row justify-content-left">

    @foreach($users as $user)
    <div class="col-md-6">
      <div class="data-user row justify-content-left align-items-center mt-3 mb-5">
        <div class="img-profile col-4 col-md-3">
          @if($user->image)
          <img src="{{ route('user.image', array('filename' => $user->image)) }}" alt="{{ $user->nick }}" class="">
          @endif
        </div>
        <div class="col-8 col-md-9">
          <a href="{{ route('user.profile', array('id' => $user->id)) }}">
            <h2> {{ '@' . $user->nick }}</h2>
          </a>
          <h4>{{ $user->name . ' ' . $user->surname}}</h4>
          <small>{{ count($user->images) . ' Publicaciones' }}</small>
          <div class="mt-2">
            <a href="{{ route('user.profile', array('id' => $user->id)) }}" class="btn btn-info btn-sm">Visitar perfil</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- paginación -->
  <div class="clear-fix"> </div>
  {{ $users->links() }}
</div>
@endsection