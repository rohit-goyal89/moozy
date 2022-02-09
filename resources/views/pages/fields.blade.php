<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', $page->title ?? '', ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', $page->description ?? '', ['class' => 'form-control editor','id'=>'editor']) !!}
</div>


<!-- Meta Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_tag', 'Meta Tag:') !!}
    {!! Form::text('meta_tag', $page->meta_tag ?? '', ['class' => 'form-control']) !!}
</div>

<!-- Meta Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_key', 'Meta Key:') !!}
    {!! Form::text('meta_key', $page->meta_key ?? '', ['class' => 'form-control']) !!}
</div>

<!-- Meta Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_description', 'Meta Description:') !!}
    {!! Form::textarea('meta_description', $page->meta_description ?? '', ['class' => 'form-control','id'=>'editor1']) !!}
</div> 

<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($page) )
<input data-id="{{$page->id ?? 0}}" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" name="status" {{ $page->status ? 'checked' : '' }}>
@else
<input data-id="0" class="toggle-class form-control" type="checkbox" data-onstyle="success" data-offstyle="danger" name="status" data-toggle="toggle" data-on="Active" data-off="InActive">
@endif
</div>
