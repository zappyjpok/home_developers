<!-- Input name of the feature -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, array('required',
    'class' => 'form-control',
    'placeholder' => 'House Type')) !!}
</div>
<!-- Input the descriction -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, array('required',
    'class' => 'form-control',
    'placeholder' => 'Please describe the house type here!')) !!}
</div>


<div class="row">
    <h3> What features are included in the house? </h3>
    <div class="row">
        <?php $i=0; $len=count($features) ?>
        @foreach($features as $feature)
            @if($i === 4)
                {!! $row !!}
            @endif
            <?php if($i == 4) {$i=0;} ?>

            <div class="col-md-2 col-xs-6">
                <!-- if the page is create -->
                @if (isset($edit))

                    {!! Form::label($feature->name, $feature->name) !!}
                    <input type="checkbox" name="check[]" value="{{ $feature->id }}"
                            @if (in_array($feature->id, $feature_ids)))
                            {{ $checked }}
                            @endif />

                 @else
                     {!! Form::label($feature->name, $feature->name) !!}
                     <input type="checkbox" name="check[]" value="{{ $feature->id }}"/>
                 @endif
            </div>
            <?php $i++ ?>
            @if($i === 4)
                {!! $rowClose !!}
            @endif
            @if($len === 0  && $i != 4)
                {!! $rowClose !!}
            @endif
        @endforeach

</div>

<div class="form-group" class="row">
    {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>