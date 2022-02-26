<!-- Coupon Type Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('attribute_id', 'Attribute:') !!}
    {!! Form::select('attribute_id',$attributes , null, ['class' => 'form-control']) !!}
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($attributeValue) )
<input data-id="{{$attributeValue->id}}" name="status"  type="checkbox" {{ $attributeValue->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>