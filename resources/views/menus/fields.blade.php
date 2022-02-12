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
<input data-id="{{$menu->id ?? 0}}" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" name="status" {{ $menu->status ? 'checked' : '' }}>
@else
<input data-id="0" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" name="status" data-toggle="toggle" data-on="Active" data-off="InActive">
@endif
</div>