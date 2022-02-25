<!-- Offer Field -->
<div class="col-sm-6">
    {!! Form::label('offer', 'Offer:') !!}
</div>

<!-- Discount Field -->
<div class="col-sm-6">
    {!! Form::label('discount', 'Discount:') !!}
    <p>{{ $offer->discount }}</p>
</div>
<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('restaurant', 'Restaurants:') !!}
    <ul>
    @if($offer->restaurants)
        @foreach($offer->restaurants as $value)
        <li>{{ $value->name }}</li>
        @endforeach
    @else
         <li>No Record Found</li>
    @endif
    </ul>
</div>
<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    @if($offer->status == 1)
        <p>Active</p>
    @else
         <p>InActive</p>
    @endif
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $offer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $offer->updated_at }}</p>
</div>

