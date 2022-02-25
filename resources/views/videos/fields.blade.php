<!-- From Date Field -->

<div class="form-group col-sm-6 required"> 
    {!! Form::label('file', 'Video File:',['class'=>'control-label']) !!}
    {!! Form::file('file', array('id' => 'photo','class'=>'form-control')) !!}
    @if(!empty($video->file))
    <span>
        <a href="{{ url('images/'.$video->file) }}" alt="" target="_blank" title="">View</a>
    </span>
    @endif
</div>

<!-- To Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null , ['class' => 'form-control']) !!}
</div>
</div>
<!-- To Date Field -->
<div class="row">
<div class="form-group col-sm-6">
    {!! Form::label('discount_type', 'Discount Type:') !!}<br>
    {{ Form::radio('discount_type', '1') }} <span>Percentage(%)</span> &nbsp;&nbsp;&nbsp;&nbsp;
    {{ Form::radio('discount_type', '2') }} <span>Amount</span>

</div>
</div>
<!-- Amount Field -->
<div class="row">

<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('min_price', 'Minimum Price:') !!}
    {!! Form::text('min_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Type Field -->
<!--<div class="form-group col-sm-6 required">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type',config('app.coupon_type') , null, ['class' => 'form-control']) !!}
</div>-->

<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($video) )
<input data-id="{{$video->id}}" name="status"   type="checkbox" {{ $video->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>