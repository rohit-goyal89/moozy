<!-- Name Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control required']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12 required">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control required']) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('postcode', 'Postcode:') !!}
    {!! Form::text('postcode', null, ['class' => 'form-control required']) !!}
</div>
<!-- Latitude Field -->
<div class="form-group col-sm-12 col-lg-12 required">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::text('latitude', null, ['class' => 'form-control required']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::text('longitude', null, ['class' => 'form-control required']) !!}
</div>

<!-- Food Prepare Time Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('prepare_time', 'Food Prepare Time:') !!}
    {!! Form::text('prepare_time', null, ['class' => 'form-control required']) !!}
</div>
<!-- City Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control required']) !!}
</div>

<!-- Town Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('town', 'Town:') !!}
    {!! Form::text('town', null, ['class' => 'form-control required']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control required']) !!}
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
    {!! Form::text('owner_name', null, ['class' => 'form-control required']) !!}
</div>

<!-- Contact Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_number', 'Contact Number:') !!}
    {!! Form::text('contact_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control required']) !!}
</div>

<!-- Restaurant Type Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('restaurant_type', 'Restaurant Type:') !!}
    {!! Form::select('restaurant_type', config('app.restaurant_type'), null, ['class' => 'form-control custom-select required']) !!}
</div>


<!-- Menu Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('menu', 'Menus:') !!}
    {!! Form::select('menu[]',$menus , $selectedMenus, ['class' => 'form-control js-example-basic-multiple required','multiple'=>"multiple"]) !!}
</div>
<!-- Category Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('category', 'Categories:') !!}
    {!! Form::select('category[]',$categories , $selectedCat, ['class' => 'form-control js-example-basic-multiple required','multiple'=>"multiple"]) !!}
</div>
</div>
<div class="row">
    <div class="form-group col-sm-4 required">
        {!! Form::label('day', 'Day:') !!}
        {!! Form::select('day', config('app.day'), null, ['class' => 'form-control custom-select required']) !!}
     </div>
    <div class="form-group col-sm-4 required"> 
        {!! Form::label('open_time', 'Open Time(In 24 Hours):') !!}
        {!! Form::text('open_time', null, ['type'=>"time",'class' => 'form-control required time','placeholder'=>"hh:mm"]) !!}
    </div>
    <div class="form-group col-sm-4"> 
        {!! Form::label('closing_time', 'Closing Time(In 24 Hours):') !!}
        {!! Form::text('closing_time', null, ['type'=>"time",'class' => 'form-control required time','placeholder'=>"hh:mm"]) !!}
    </div>
    <div class="form-group col-sm-4 required"></div>
    <div class="form-group col-sm-4 required"></div>
     <div class="form-group col-sm-4">
                {!! Form::button('Add', ['class' => 'btn btn-primary add_manage_store']) !!}
    </div>
</div>
<div class="table-responsive">
    <table class="table" id="manage_store_time">
         <thead>
            <tr>
                <th>Day</th>
                <th>Open Time</th>
                <th>Closing Time</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($restaurant['manageTime']))
                @foreach($restaurant['manageTime'] as $key => $manageTime)
                <tr><input type="hidden" name="manage_restaurant[@php echo $key @endphp][day]" value="{{ $manageTime->day }}"><input type="hidden" name="manage_restaurant[{{$key}}][open_time]" value="{{$manageTime->open_time}}"><input type="hidden" name="manage_restaurant[{{$key}}][close_time]" value="{{$manageTime->close_time}}"><td>{{config('app.day')[$manageTime->day]}}</td><td>{{$manageTime->open_time}}</td><td>{{$manageTime->close_time}}</td></tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
</div>    
<div class="row">
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
<div class="form-group col-sm-6 required"> 
    {!! Form::label('photo', 'Picture Upload:',['class'=>'control-label']) !!}
    {!! Form::file('photo', array('id' => 'photo','class'=>'form-control required')) !!}
    @if(!empty($restaurant->restaurantDetail->photo))
    <span>
        <a href="{{ url('images/'.$restaurant->restaurantDetail->photo) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif

</div>
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}

@if(isset($restaurant) )
<input data-id="{{$restaurant->id}}" name="status"   type="checkbox" {{ $restaurant->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>

