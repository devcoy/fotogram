@extends('layouts.app')

@section('content')
<div class="container">
  @include ('includes.message') 
  <div class="row justify-content-left">
    @if($images && count($images) > 0)
    @foreach($images as $image)
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
  {{ $images->links() }}
</div>
@endsection