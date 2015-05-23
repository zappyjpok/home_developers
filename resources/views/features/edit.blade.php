
@extends('layouts.layout')


@section('content')
    @include('layouts._nav')
    @include('layouts._jumboTron')

    @include('errors._errorsList')

    {!! Form::model($feature, ['method' => 'PATCH', 'action' => ['FeatureController@update', $feature->id]]) !!}

    @include('features.partials._forms', ['submitButton' => 'Update Feature'])

    {!! Form::close() !!}

@stop

@section('footer')
    @include('layouts._footer')
    @include('layouts._js')
@stop