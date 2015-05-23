@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<div>
                        <ul>
                            <li> <a href="{{ URL::to('features') }}"> Features </a> </li>
                            <li> <a href="{{ URL::to('houses') }}"> House </a>  </li>
                            <li> About Us</li>
                        </ul>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
