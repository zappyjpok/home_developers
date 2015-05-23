
<div class="row">
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle"
                    data-toggle="collapse" data-target="#collapse">
                <span class="sr-only"> Toggle navigation </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ action('WelcomeController@index') }}"> Home </a></li>
                <li><a href="{{ action('FeatureController@index') }}"> Features </a></li>
                <li><a href="{{ action('HouseController@index') }}"> Houses</a></li>
                <li><a href="#"> Images </a></li>
                <li><a href="#"> About Us </a></li>
             </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ URL::to('auth/login')  }}">Login</a></li>
            </ul>
        </div>
    </nav>
</div>
