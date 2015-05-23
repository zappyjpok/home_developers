@extends('layouts.layout')


@section('content')

    @include('layouts._nav')
    @include('layouts._jumboTron')

    @if(isset($results))
        <ul>
            @foreach($results as $result)
                <li> {{ $result }}</li>
            @endforeach
        </ul>
    @endif
    <?php $i=0; ?>
    @if(isset($features))
        <article class="row">
        @foreach($features as $feature)
            @if($i === 4)
                {!! $row !!}
            @endif
            <?php if($i == 4) {$i=0;} ?>
                <section class="col-md-3 col-xs-6">
                    <h3>
                        <a href="{{ action('FeatureController@show', [$feature->id]) }}"> {{ $feature->name }} </a>
                    </h3>
                    <div> <img src="{{ \App\Services\ChangeName::changeToThumbnail($feature->FeatureImages->first()->imagePath . $feature->FeatureImages->first()->image) }}" ></div>
                    <p> {{ $feature->description }}</p>
                    @if (Auth::user())
                        <div>
                            <div class="float-left">
                                <a href="{{ action('FeatureController@edit', [$feature->id]) }}" class="btn btn-info btn-sm"> Edit Feature </a>
                            </div>
                            <div class="float-left">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['features.destroy', $feature->id ]]) !!}
                                     {!! Form::submit('Delete', ['class' => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                            </div>

                        </div>
                    @endif
                </section>
                <?php $i++ ?>
                @if($i === 4)
                    {!! $rowClose !!}
                @endif
        @endforeach
    @endif

@stop

@section('footer')
    @include('layouts._footer')
    @include('layouts._js')
@stop