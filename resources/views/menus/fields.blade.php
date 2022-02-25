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
<!-- Menu IS Customizable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'If Menu Customizable then its single or multi type:') !!}<br>
    {{ Form::radio('type', '1') }} <span>Single</span> &nbsp;&nbsp;&nbsp;&nbsp;
    {{ Form::radio('type', '2') }} <span>Multiple</span>
</div>
</div>
<div class="row">
    
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
</div>
<div class="table-responsive">
    <table class="table" id="manage_menu_store">
         <thead>
            <tr>
                <th>Submenu</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($menu['submenus']))
                @foreach($menu['submenus'] as $key => $submenus)
                <tr row-id="{{$key}}"><input type="hidden" name="manage_menu[@php echo $key @endphp][name]" value="{{ $submenus->name }}"><input type="hidden" name="manage_menu[{{$key}}][price]" value="{{$submenus->price}}"><td>{{$submenus->name}}</td><td>{{$submenus->price}}</td><td><a href="javascript:void(0)" class="delete_sub_menu" data-id="{{$submenus->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
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