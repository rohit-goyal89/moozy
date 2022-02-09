<!-- Name Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12 required">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('postcode', 'Postcode:') !!}
    {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Town Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('town', 'Town:') !!}
    {!! Form::text('town', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Alternate Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alternate_phone', 'Alternate Phone:') !!}
    {!! Form::text('alternate_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Registration Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('registration_date', 'Registration Date:') !!}
    {!! Form::text('registration_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Gst Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gst_number', 'Gst Number:') !!}
    {!! Form::text('gst_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Owner Name Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('owner_name', 'Owner Name:') !!}
    {!! Form::text('owner_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_number', 'Contact Number:') !!}
    {!! Form::text('contact_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Restaurant Type Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('restaurant_type', 'Restaurant Type:') !!}
    {!! Form::select('restaurant_type', config('app.restaurant_type'), null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Menu Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('menu', 'Menus:') !!}
    {!! Form::select('menu[]',$menus , $selectedMenus, ['class' => 'form-control js-example-basic-multiple','multiple'=>"multiple"]) !!}
</div>

<div class="form-group col-sm-6"> 
    {!! Form::label('shop_licence', 'Shop Licence:',['class'=>'control-label']) !!}
    {!! Form::file('shop_licence', array('id' => 'shop_licence','class'=>'form-control')) !!}
    @if(!empty($restaurant->restaurantDetail->shop_licence))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->shop_licence) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif
</div>
 
<div class="form-group col-sm-6"> 
    {!! Form::label('gst_pan_number', 'GST. PAN Number:',['class'=>'control-label']) !!}
    {!! Form::file('gst_pan_number', array('id' => 'gst_pan_number','class'=>'form-control')) !!}
     @if(!empty($restaurant->restaurantDetail->gst_pan_number))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->gst_pan_number) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif

</div>
<div class="form-group col-sm-6"> 
    {!! Form::label('photo', 'Picture Upload:',['class'=>'control-label']) !!}
    {!! Form::file('photo', array('id' => 'photo','class'=>'form-control')) !!}
    @if(!empty($restaurant->restaurantDetail->photo))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->photo) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif

</div>
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($restaurant) )
<input data-id="{{$restaurant->id ?? 0}}" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" name="status" {{ $restaurant->status ? 'checked' : '' }}>
@else
<input data-id="0" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" name="status" data-toggle="toggle" data-on="Active" data-off="InActive">
@endif
</div>