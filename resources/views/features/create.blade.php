
@extends('layouts.layout')


@section('content')
    @include('layouts._nav')
    @include('layouts._jumboTron')

    @include('errors._errorsList')

    {!! Form::open(['url' => 'features']) !!}

    @include('features.partials._forms', ['submitButton' => 'Add Feature'])

    {!! Form::close() !!}

@stop

@section('footer')
    @include('layouts._footer')
    @include('layouts._js')
@stop