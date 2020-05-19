@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @include ('includes.message')

      @foreach($images as $image)
      <div class="card">
        <div class="card-header">
          @if($image->user->image)
          <img src="{{ route('user.image', array('filename' => $image->user->image)) }}" alt="{{ $image->user->nick }}" class="image-card__img-profile">
          @endif
          <strong>{{ $image->user->name . ' ' . $image->user->surname }}</strong><br />
          <small>@ {{ $image->user->nick}}</small>
        </div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          You are logged in!
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection