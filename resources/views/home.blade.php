@extends('layouts.app')

@section('content')
<div class="container">
  @include ('includes.message')
  <div class="row justify-content-left">
    @foreach($images as $image)
    <div class="col-md-6">
      <div class="image-card card mb-5">
        <div class="card-header">
          @if($image->user->image)
          <img src="{{ route('user.image', array('filename' => $image->user->image)) }}" alt="{{ $image->user->nick }}" class="image-card__img-profile">
          @endif
          <strong>{{ $image->user->name . ' ' . $image->user->surname }}</strong>
        </div>

        <div class="card-body p-0">
          <div class="image-card__container">
            @if($image->image_path)
            <a href="{{ route('image.detail', array('id' => $image->id)) }}">
              <img src="{{ route('image.file', array('filename' => $image->image_path)) }}" alt="" class="">
            </a>
            @else
            <img src="{{ asset('img/img-default.svg') }}" alt="Imagen default" class="">
            @endif
          </div>
          <div class="image-card__description px-3 pt-3">
            <span class="image-card__nick">{{'@' . $image->user->nick }}</span> <small>{{ $image->created_at }}</small>
            <p>{{ $image->description}}</p>
          </div>
          <div class="image-card__likes-comments row justify-content-left p-3 pt-0">
            <div class="col-6 likes">
              <a href="#">
                <img src="{{ asset('img/likes.svg') }}" alt="Likes" width="15px" class="">
              </a>
              <span>{{ count($image->likes) }} Likes</span>
            </div>
            <div class="col-6 comments">
              <a href="#">
                <img src="{{ asset('img/comments.svg') }}" alt="Comments" width="15px" class="">
              </a>
              <span>{{ count($image->comments) }} Comentarios</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    @endforeach
  </div>
  <!-- paginación -->
  <div class="clear-fix"> </div>
  {{ $images->links() }}
</div>
@endsection