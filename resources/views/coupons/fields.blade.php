<!-- From Date Field -->

<div class="form-group col-sm-6">
    {!! Form::label('from_date', 'From Date:') !!}
    {!! Form::text('from_date', !empty($coupon->from_date) ? date('d/m/Y',strtotime($coupon->from_date)) : null, ['class' => 'form-control datepicker']) !!}
</div>

<!-- To Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_date', 'To Date:') !!}
    {!! Form::text('to_date', !empty($coupon->to_date) ? date('d/m/Y',strtotime($coupon->to_date)) : null , ['class' => 'form-control datepicker']) !!}
</div>
</div>
<!-- Coupon Code Field -->
<div class="row">
    <div class="form-group col-sm-8">
        {!! Form::label('coupon_code', 'Coupon Code:') !!}
        {!! Form::text('coupon_code', null, ['class' => 'form-control']) !!}
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
<div class="form-group col-sm-6 required">
    {!! Form::label('type', 'Coupon Type:') !!}
    {!! Form::select('type',config('app.coupon_type') , null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($coupon) )
<input data-id="{{$coupon->id ?? 0}}" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" name="status" {{ $coupon->status ? 'checked' : '' }}>
@else
<input data-id="0" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" name="status" data-toggle="toggle" data-on="Active" data-off="InActive">
@endif
</div>