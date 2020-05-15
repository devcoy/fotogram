@if(Auth::user()->image)
<img src="{{ route('user.image', array('filename' => Auth::user()->image)) }}" alt="{{ Auth::user()->name }}" class="">
@endif