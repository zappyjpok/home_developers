@extends('layouts.layout')


@section('content')
    @include('layouts._nav')
    @include('layouts._jumboTron')
    <article class="row">
        <div class="col-md-3"> <img src="{{ $link }}" alt="{{ $link }}"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <h2> {{ $house->name }} </h2>
            <p> {{ $house->description }} </p>
        </div>
        <div class="col-md-3"></div>
    </article>
    <article class="row top-border">
        <h2> {{ $house->name }} has the following features </h2>
            @foreach($house->features as $feature)
                <section class="col-md-3">
                    @if($i === 4)
                        {!! $row !!}
                    @endif
                    <h3> {{ $feature->name }} </h3>
                    <img src="{{ \App\Services\ChangeName::changeToThumbnail($feature->featureImages->first()->imagePath . $feature->featureImages->first()->image)   }}" /> </h2>
                    <p> {{ $feature->description }}</p>
                    <?php $i++ ?>
                    @if($i === 4)
                        {!! $rowClose !!}
                    @endif
                    <?php if($i == 4) {$i=0;} ?>
                </section>
            @endforeach
    </article>
@stop

@section('footer')
    @include('layouts._footer')
    @include('layouts._js')
@stop
