<!-- Name Field -->
<div class="col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $cuisine->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $cuisine->description }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    @if($cuisine->status == 1)
    <p>{{ 'Active' }}</p>
    @else
    <p>{{ 'InActive' }}</p>
    @endif
</div>
<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cuisine->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cuisine->updated_at }}</p>
</div>

