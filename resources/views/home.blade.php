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
          <strong>{{ $image->user->name . ' ' . $image->user->surname }}</strong> |
          <small>@ {{ $image->user->nick}}</small>
        </div>

        <div class="card-body p-0">
          <div class="image-card__container">
            @if($image->image_path)
            <img src="{{ route('image.file', array('filename' => $image->image_path)) }}" alt="" class="">
            @endif
          </div>
          <div class="image-card__likes-comments row justify-content-left p-2">
            <div class="col-6 likes">
              <img src="img/likes.svg" alt="Likes" width="15px" class=""> <span>{{ count($image->likes) }} Likes</span>
            </div>
            <div class="col-6 comments">
              <img src="img/comments.svg" alt="Comments" width="15px" class=""> <span>{{ count($image->comments) }} Comentarios</span>
            </div>            
          </div>
          <div class="image-card__description p-2">
            <p>{{ $image->description}}</p>
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