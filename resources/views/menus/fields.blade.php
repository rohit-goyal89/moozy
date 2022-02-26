<!-- Title Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!-- Price Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Menu Prepare Time Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('prepare_time', 'Prepare Time (In Minute):') !!}
    {!! Form::text('prepare_time', null, ['class' => 'form-control']) !!}
</div>
<!-- Menu IS Customizable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_customizable', 'Is Customizable:') !!}<br>
    {{ Form::radio('is_customizable', '1') }} <span>Yes</span> &nbsp;&nbsp;&nbsp;&nbsp;
    {{ Form::radio('is_customizable', '0') }} <span>No</span>

</div>
</div>
<!--<div class="row">
    
    <div class="form-group col-sm-4 required"> 
        {!! Form::label('submenu', 'Submenu:') !!}
        {!! Form::text('submenu', null, ['class' => 'form-control required','placeholder'=>"submenu"]) !!}
    </div>
    <div class="form-group col-sm-4"> 
        {!! Form::label('sub_price', 'Price:') !!}
        {!! Form::text('sub_price', null, ['class' => 'form-control required','placeholder'=>"price"]) !!}
    </div>
    <div class="form-group col-sm-4" style="padding-top: 30px;">
        {!! Form::button('Add', ['class' => 'btn btn-primary add_submenu']) !!}
    </div>
</div>-->
<?php //dd($attributes) ?>
<div class="row">
     <p style="display: block;
    width: 100%;"><strong>Customize Attribute:</strong></p><br/>
            @if(!empty($attributes))
                @foreach($attributes as $value)
                 <div class="form-group col-sm-2"> 
                  <label> {{$value->name}} </label>
                  <input  name="customize_attr[<?php echo $value->id ?>]" type="checkbox">
                  
                    @if(!empty($value->attributeValues))
                        <ul style="list-style: none;">
                        @foreach($value->attributeValues as $val)
                        <li>Name: {{$val->name}}</li>
                        <li>Price: {{$val->price}}</li>
                        <li>Quanity: {{$val->quantity}}</li>
                        @endforeach
                    </ul>
                    @endif
                 </div>
                @endforeach
            @endif
</div> 
<div class="row">   
<!-- Menu Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('categories', 'Categories:') !!}
    {!! Form::select('category[]',$categories , $selectedCat, ['class' => 'form-control js-example-basic-multiple','multiple'=>"multiple"]) !!}
</div>
<div class="form-group col-sm-6 required"> 
    {!! Form::label('photo', 'Menu Photo:',['class'=>'control-label']) !!}
    {!! Form::file('photo', array('id' => 'photo','class'=>'form-control')) !!}
    @if(!empty($menu->image))
    <span>
        <a href="{{ url('images/'.$menu->image) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif
</div>
<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($menu) )
<input data-id="{{$menu->id}}" name="status"   type="checkbox" {{ $menu->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>