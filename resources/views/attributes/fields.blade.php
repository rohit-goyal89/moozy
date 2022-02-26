<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<!-- Menu IS Customizable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_required', 'Is Required:') !!}<br>
    {{ Form::radio('is_required', '1') }} <span>Yes</span> &nbsp;&nbsp;&nbsp;&nbsp;
    {{ Form::radio('is_required', '0',['default'=>'checked']) }} <span>No</span>

</div>
<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($attribute) )
<input data-id="{{$attribute->id}}" name="status"  type="checkbox" {{ $attribute->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>