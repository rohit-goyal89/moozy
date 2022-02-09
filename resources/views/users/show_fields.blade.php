<!-- Created At Field -->
<div class="col-sm-6">
    @if(Request::query('role') ==2) 
    {!! Form::label('name', 'Owner Name:') !!}
    @elseif(Request::query('role') ==3)
    {!! Form::label('name', 'Driver Name:') !!}
    @else
    {!! Form::label('name', 'Name:') !!}
    @endif
    <p>{{ $user->name }}</p>
</div>
<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>
<!-- Created At Field -->
<div class="col-sm-6"> 
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    <p>{{ $user->mobile_no }}</p>
</div>
@if(Request::query('role') ==2) 
<div class="form-group col-sm-6"> 
    {!! Form::label('restaurant_name', 'Restaurant Name:') !!}
    <p>{{ $user->restaurant_name ?? '' }} </p>
</div>
<div class="form-group col-sm-6"> 
    {!! Form::label('vat_no', 'VAT Number:',) !!}
    <p>{{$user->vat_no ?? ''}}</p>
</div>

<div class="form-group col-sm-12"> 
    {!! Form::label('address', 'Address:') !!}
    <p>{{$user->address ?? ''}}</p>
</div>
@elseif(Request::query('role') ==3)

<div class="form-group col-sm-6"> 
    {!! Form::label('photo', 'Driver Photo:') !!}
    <span>
        <a href="{{ url('storage/images/'.$user->userDetail->photo) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
</div>
 

<div class="form-group col-sm-6"> 
    {!! Form::label('licence_file', 'Driver Licence:') !!}
      <a href="{{ url('storage/images/'.$user->userDetail->licence_file) }}" target="_blank" alt="" title="">{{ $user->userDetail->licence_file }}</a>

</div>
@endif 
<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <p>Active</p>
</div>
<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $user->updated_at }}</p>
</div>

