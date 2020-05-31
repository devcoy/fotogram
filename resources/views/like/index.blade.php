@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Publicaciones que me gustan</h1>
  <div class="row justify-content-left">
    @foreach($images as $image)
    <div class="col-md-6">
    @include('includes.single-image', array('image' => $image->image))
    </div>
    @endforeach

    <!-- paginación -->
    <div class="clear-fix"> </div>
    {{ $images->links() }}
  </div>
  @endsection