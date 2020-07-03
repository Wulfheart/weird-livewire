@extends('layouts.app')

@section('content')
<form action="{{ route('viz.post') }}" method="post">
    @csrf
    <div>
        <input type="file" name="midi" accept="audio/midi" id="">
    </div>
    <div>
        <input type="color" name="colors[]">
        <input type="color" name="colors[]">
    </div>
    <button type="submit">Submit</button>
</form>
    
@endsection


