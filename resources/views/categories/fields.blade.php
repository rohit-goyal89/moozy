<!-- Parent Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_category_id', 'Parent Category:') !!}
    {!! Form::select('parent_category_id', $categories, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}

@if(isset($category) )
<input data-id="{{$category->id ?? 0}}" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" name="status" {{ $category->status ? 'checked' : '' }}>
@else
<input data-id="0" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" name="status" data-toggle="toggle" data-on="Active" data-off="InActive">
@endif
</div>