<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $page->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $page->description !!}</p>
</div>

<!-- Meta Tag Field -->
<div class="col-sm-12">
    {!! Form::label('meta_tag', 'Meta Tag:') !!}
    <p>{{ $page->meta_tag }}</p>
</div>

<!-- Meta Key Field -->
<div class="col-sm-12">
    {!! Form::label('meta_key', 'Meta Key:') !!}
    <p>{{ $page->meta_key }}</p>
</div>

<!-- Meta Description Field -->
<div class="col-sm-12">
    {!! Form::label('meta_description', 'Meta Description:') !!}
    <p>{!! $page->meta_description !!}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p> @if($page->status  == 1)
                <td>{{ "Active" }}</td>
            @else
                <td>{{ "InActive" }}</td>
            @endif</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $page->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $page->updated_at }}</p>
</div>

