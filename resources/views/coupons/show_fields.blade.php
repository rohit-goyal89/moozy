<!-- From Date Field -->
<div class="col-sm-6">
    {!! Form::label('from_date', 'From Date:') !!}
    <p>{{ $coupon->from_date }}</p>
</div>

<!-- To Date Field -->
<div class="col-sm-6">
    {!! Form::label('to_date', 'To Date:') !!}
    <p>{{ $coupon->to_date }}</p>
</div>

<!-- Coupon Code Field -->
<div class="col-sm-6">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    <p>{{ $coupon->coupon_code }}</p>
</div>

<!-- Discount Type Field -->
<div class="col-sm-6">
    {!! Form::label('discount_type', 'Discount Type:') !!}
    @if($coupon->discount_type == 1)
    <p>{{ 'Percentage' }}</p>
    @else
    <p>{{ 'Amount' }}</p>
    @endif
</div>

<!-- Amount Field -->
<div class="col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $coupon->amount }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-6">
    {!! Form::label('min_amount', 'Minimum Amount:') !!}
    <p>{{ $coupon->min_price }}</p>
</div>

<!-- Coupon Type Field -->
<div class="col-sm-6">
    {!! Form::label('type', 'Coupon Type:') !!}
     @if($coupon->type == 1)
    <p>{{ 'Single' }}</p>
    @else
    <p>{{ 'Multiple' }}</p>
    @endif
</div>

<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    @if($coupon->status == 1)
                <p>{{ 'Active' }}</p>
                @else
                <p>{{ 'InActive' }}</p>
                @endif
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $coupon->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $coupon->updated_at }}</p>
</div>

