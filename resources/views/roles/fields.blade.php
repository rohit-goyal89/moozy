<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $role->name ?? '', ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('permission', 'Permission:') !!}<br/>
    <div class="row">
    	<div class="col-sm-4">
    <ul style="list-style: none;">
    	@php $ind = 1;  @endphp
     @foreach($permission as $value)
        <li>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
        {{ $value->name }}</li>
        @if($ind %4 ==0 && $ind>0) 
    </ul></div><div class="col-sm-4"><ul style="list-style: none;">
        @endif
        @php $ind++;  @endphp
    @endforeach
</ul>
</div>
</div>
</div>

