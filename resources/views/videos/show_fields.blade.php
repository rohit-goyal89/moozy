

<!-- To Date Field -->
<div class="col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $video->url }}</p>
</div>


<!-- Discount Type Field -->
<div class="col-sm-6">
    {!! Form::label('discount_type', 'Discount Type:') !!}
    @if($video->discount_type == 1)
    <p>{{ 'Percentage' }}</p>
    @else
    <p>{{ 'Amount' }}</p>
    @endif
</div>

<!-- Amount Field -->
<div class="col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $video->amount }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-6">
    {!! Form::label('min_amount', 'Minimum Amount:') !!}
    <p>{{ $video->min_price }}</p>
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
    @if($video->status == 1)
                <p>{{ 'Active' }}</p>
                @else
                <p>{{ 'InActive' }}</p>
                @endif
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $video->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $video->updated_at }}</p>
</div>

