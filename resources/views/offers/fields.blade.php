<!-- Offer Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('offer', 'Offer:') !!}
    {!! Form::text('offer', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('discount', 'Discount:') !!}
    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Restaurant Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('restaurant', 'Restaurants:') !!}
    {!! Form::select('restaurant[]',$restaurants , $selectedRest, ['class' => 'form-control js-example-basic-multiple','multiple'=>"multiple"]) !!}
</div>

<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($offer) )
<input data-id="{{$offer->id ?? 0}}" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" name="status" {{ $offer->status ? 'checked' : '' }}>
@else
<input data-id="0" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" name="status" data-toggle="toggle" data-on="Active" data-off="InActive">
@endif
</div>