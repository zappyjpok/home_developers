@extends('layouts.layout')


@section('content')
    @include('layouts._nav')
    @include('layouts._jumboTron')

        <article class="row">
            <div class="col-md-3"> <img src="{{ $link }}" alt="{{ $link }}"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <h2> {{ $feature->name }} </h2>
                <p> {{ $feature->description }} </p>
            </div>
            <div class="col-md-3"></div>
        </article>
@stop

@section('footer')
    @include('layouts._footer')
    @include('layouts._js')
@stop