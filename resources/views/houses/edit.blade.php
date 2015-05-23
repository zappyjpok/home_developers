
@extends('layouts.layout')


@section('content')
    @include('layouts._nav')
    @include('layouts._jumboTron')

    @include('errors._errorsList')
    {!! Form::model($house, ['method' => 'PATCH', 'action' => ['HouseController@update', $house->id]]) !!}

    @include('houses.partials._forms', ['submitButton' => 'Update House'])

    {!! Form::close() !!}

@stop

@section('footer')
    @include('layouts._footer')
    @include('layouts._js')
@stop