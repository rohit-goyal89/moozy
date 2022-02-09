<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact', 'Contact:') !!}
    {!! Form::text('contact', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Flag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_flag', 'Is Flag:') !!}
    {!! Form::select('is_flag', config('app.support_type'), null, ['class' => 'form-control custom-select']) !!}
</div>
