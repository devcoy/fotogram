@extends('layouts.app')

@section('content')
<div class="container">
  @include ('includes.message')
  <div class="row justify-content-left">
    <div class="col-md-10 offset-md-1">
      <div class="image-card card mb-5">
        <div class="card-header">
          @if($image->user->image)
          <img src="{{ route('user.image', array('filename' => $image->user->image)) }}" alt="{{ $image->user->nick }}" class="image-card__img-profile">
          @endif
          <strong>{{ $image->user->name . ' ' . $image->user->surname }}</strong>
        </div>

        <div class="card-body p-0">
          <div class="full-image__container">
            @if($image->image_path)
            <img src="{{ route('image.file', array('filename' => $image->image_path)) }}" alt="" class="full-image">
            @else
            <img src="{{ asset('img/img-default.svg') }}" alt="Imagen default" class="">
            @endif
          </div>
          <div class="image-card__description px-3 pt-3">
            <span class="image-card__nick">{{'@' . $image->user->nick }}</span> <small>{{' | ' .  \FormatTime::LongTimeFilter($image->created_at) }}</small>
            <p>{{ $image->description}}</p>
          </div>
          <div class="image-card__likes-comments row justify-content-left px-3 pt-0 pb-1">
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
          <hr class="mx-3">
          <div class="comments row justify-content-left p-3">
            @foreach($image->comments as $comment)
            <div class="comment px-3 pb-3 w-100">
              <strong>{{ '@' . $comment->user->nick }}</strong>
              {{ $comment->content }}
              <small class="date w-100 d-block">
                {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                @if(Auth::check() && ($comment->user_id === Auth::user()->id || $comment->image->user_id === Auth::user()->id))
                <a href="{{ route('comment.delete', array('id' => $comment->id))}}" class="ml-2">Eliminar</a>
                @endif
              </small>
            </div>
            @endforeach
            <form action="{{ route('comment.save') }}" method="post" class="col-12 pt-3">
              @csrf
              <input type="hidden" name="image_id" value="{{ $image->id }}">
              <div class="form-group">
                <textarea name="content" cols="30" rows="3" class="form-control @error('content') is-invalid @enderror" placeholder="Comentario..." required></textarea>
                @error('content')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="text-right">
                <input type="submit" value="Comentar" class="btn btn-primary btn-sm">
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection