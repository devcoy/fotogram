@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if(session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h1>Crear publicación</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>
              <div class="col-md-6">
                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" required autofocus>
                @error('image_path')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
              <div class="col-md-6">
                <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Publicar imagen
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection