@extends('layouts.layout')



@section('content')
    <h1> {{ $pageTitle }} to  </h1>

    @if(isset($name))
        <h2> {{$name }} </h2>
        @endif

                <!-- Form upload image -->
        <div>
            {!! Form::open(array('url' => 'house/image/store', 'method' => 'POST', 'files' => true)) !!}
            {!! Form::file('image') !!}
            {!! Form::submit('Upload', ['class' => 'btn btn-primary form-control', 'name' => 'upload']) !!}
            {!! Form::close() !!}
        </div>
@stop
