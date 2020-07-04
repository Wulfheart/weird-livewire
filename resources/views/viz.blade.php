@extends('layouts.app')

@section('content')
<viz endpoint="{{ route('viz.post') }}"></viz>
    
@endsection


