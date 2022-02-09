<!-- Name Field -->
<div class="col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $restaurant->name }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $restaurant->address }}</p>
</div>

<!-- Postcode Field -->
<div class="col-sm-6">
    {!! Form::label('postcode', 'Postcode:') !!}
    <p>{{ $restaurant->postcode }}</p>
</div>

<!-- City Field -->
<div class="col-sm-6">
    {!! Form::label('city', 'City:') !!}
    <p>{{ $restaurant->city }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $restaurant->phone }}</p>
</div>

<!-- Alternate Phone Field -->
<div class="col-sm-6">
    {!! Form::label('alternate_phone', 'Alternate Phone:') !!}
    <p>{{ $restaurant->alternate_phone }}</p>
</div>

<!-- Website Field -->
<div class="col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    <p>{{ $restaurant->website }}</p>
</div>

<!-- Registration Date Field -->
<div class="col-sm-6">
    {!! Form::label('registration_date', 'Registration Date:') !!}
    <p>{{ $restaurant->registration_date }}</p>
</div>

<!-- Gst Number Field -->
<div class="col-sm-6">
    {!! Form::label('gst_number', 'Gst Number:') !!}
    <p>{{ $restaurant->gst_number }}</p>
</div>

<!-- Contact Number Field -->
<div class="col-sm-6">
    {!! Form::label('contact_number', 'Contact Number:') !!}
    <p>{{ $restaurant->contact_number }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $restaurant->email }}</p>
</div>

<!-- Restaurant Type Field -->
<div class="col-sm-6">
    {!! Form::label('restaurant_type', 'Restaurant Type:') !!}
    <p>{{ config('app.restaurant_type')[$restaurant->restaurant_type] }}</p>
</div>
<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('menu', 'Menus:') !!}
    <ul>
    @if($restaurant->menus)
        @foreach($restaurant->menus as $value)
        <li>{{ $value->title }}</li>
        @endforeach
    @else
         <li>No Record Found</li>
    @endif
    </ul>
</div>
<!-- Shop Licence Field -->
<div class="col-sm-6">
    {!! Form::label('shop_licence', 'Shop Licence:') !!}
   @if(!empty($restaurant->restaurantDetail->shop_licence))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->shop_licence) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif
</div>

<!-- Shop Licence Field -->
<div class="col-sm-6">
    {!! Form::label('gst_pan_number', 'GST PAN Number:') !!}
   @if(!empty($restaurant->restaurantDetail->gst_pan_number))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->gst_pan_number) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif
</div>

<!-- Shop Licence Field -->
<div class="col-sm-6">
    {!! Form::label('photo', 'Picture Upload:') !!}
   @if(!empty($restaurant->restaurantDetail->photo))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->photo) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif
</div>

<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    @if($restaurant->status  == 1)
         <p>{{ "Active" }}</p>
    @else
        <p>{{ "InActive" }}</p>
    @endif
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $restaurant->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $restaurant->updated_at }}</p>
</div>

