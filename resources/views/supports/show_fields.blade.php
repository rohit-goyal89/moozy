<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $support->title }}</p>
</div>

<!-- Contact Field -->
<div class="col-sm-12">
    {!! Form::label('contact', 'Contact:') !!}
    <p>{{ $support->contact }}</p>
</div>

<!-- Is Flag Field -->
<div class="col-sm-12">
    {!! Form::label('is_flag', 'Is Flag:') !!}
    <p>@if($support->is_flag ==0)
                        Email
                     @else
                     Phone
                     @endif   </p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $support->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $support->updated_at }}</p>
</div>

