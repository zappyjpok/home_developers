<div class="jumbotron">
    <h1> {{ $pageTitle }}  </h1>
    <p> {{ $message }}</p>
    @if(isset($location) && Auth::user())
        <a href="{{ action("$location") }}" class="btn btn-info btn-lg"> {{ $button }}</a>
    @endif
</div>