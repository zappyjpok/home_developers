@extends('layouts.layout')


@section('content')

    @include('layouts._nav')
    @include('layouts._jumboTron')
    <div class="row">
        <!-- How the houses are ordered -->
        <h3> Order by</h3>
        <ul class="ul-horizontal-list">
            <li class="li-horizontal-list">
                <a href="{{ action('HouseController@index', ['order' => 1]) }}" class="btn btn-primary btn-sm"> Name A-Z</a>
            </li>
            <li class="li-horizontal-list">
                <a href="{{ action('HouseController@index', ['order' => 2]) }}" class="btn btn-primary btn-sm"> Name Z-A</a>
            </li>
            <li class="li-horizontal-list">
                <a href="{{ action('HouseController@index', ['order' => 3]) }}" class="btn btn-primary btn-sm"> Newest </a>
            </li>
            <li class="li-horizontal-list">
                <a href="{{ action('HouseController@index', ['order' => 4]) }}" class="btn btn-primary btn-sm">Oldest </a>
            </li>
        </ul>


    </div>

    @if(isset($results))
        <ul>
            @foreach($results as $result)
                <li> {{ $result }}</li>
            @endforeach
        </ul>
    @endif

    <?php $i=0; ?>
    @if(isset($houses))
        <article class="row">
            @foreach($houses as $house)
                @if($i === 4)
                    {!! $row !!}
                @endif
                <?php if($i == 4) {$i=0;} ?>
                <section class="col-md-3 col-xs-6">
                    <h3>
                        <a href="{{ action('HouseController@show', [$house->id]) }}"> {{ $house->name }} </a>
                    </h3>

                    <!-- image is not defined-->
                    <div> <img src="{{\App\Services\ChangeName::changeToThumbnail($house->HouseImages->first()->imagePath . $house->HouseImages->first()->image) }}" ></div>
                    <p> {{ $house->description }}</p>
                    @if (Auth::user())
                        <div>
                            <div class="float-left">
                                <a href="{{ action('HouseController@edit', [$house->id]) }}" class="btn btn-info btn-sm"> Edit House</a>
                            </div>
                            <div class="float-left">
                                <!-- destroy is not defined -->
                                {!! Form::open(['method' => 'DELETE', 'route' => ['houses.destroy', $house->id ]]) !!}
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