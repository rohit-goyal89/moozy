<!-- Parent Category Id Field -->
<div class="col-sm-6">
    {!! Form::label('parent_category_id', 'Parent Category:') !!}
    @if($category->parent != null)
         <p>{{ $category->parent->category }}</p>
    @else 
         <p>{{ $category->parent_category_id }}</p>
    @endif
</div>

<!-- Category Field -->
<div class="col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ $category->category }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $category->description }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    @if($category->status  == 1)
        <p>{{ "Active" }}</p>
    @else
        <p>{{ "InActive" }}</p>
    @endif
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $category->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $category->updated_at }}</p>
</div>

