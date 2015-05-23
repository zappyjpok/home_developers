<!-- Input name of the feature -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, array('required',
    'class' => 'form-control',
    'placeholder' => 'Feature Name')) !!}
</div>

<!-- Input the descriction -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, array('required',
    'class' => 'form-control',
    'placeholder' => 'Please describe the feature here!')) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>