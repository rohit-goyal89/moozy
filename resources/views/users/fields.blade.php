<div class="form-group col-sm-6">
@if(Request::query('role') ==2) 
{!! Form::label('name', 'Owner Name:',['class'=>'control-label required']) !!}
@elseif(Request::query('role') ==3)
{!! Form::label('name', 'Driver Name:',['class'=>'control-label required']) !!}	
@endif
{!! Form::text('name', $user->name ?? '', array('id' => 'name','class'=>'form-control ')) !!}
</div>
<input type="hidden" name="role_id" value="{{ Request::query('role') }}">
<div class="form-group col-sm-6">
{!! Form::label('email', 'Email:',['class'=>'control-label required']) !!}
{!! Form::email('email', $user->email ?? '', array('id' => 'email','class'=>'form-control required')) !!}
</div>
<div class="form-group col-sm-6">
{!! Form::label('mobile_no', 'Mobile No:',['class'=>'control-label required']) !!}
{!! Form::text('mobile_no', $user->mobile_no ?? '', array('id' => 'mobile_no','maxlength'=>13,'class'=>'form-control required')) !!}
</div>
<div class="form-group col-sm-6">
{!! Form::label('password', 'Password:',['class'=>'control-label required']) !!}
{!! Form::password('password', array('id' => 'password','maxlength'=>8,'class'=>'form-control required')) !!}
</div>
<div class="form-group col-sm-6">
{!! Form::label('confirm_password', 'Confirm Password:',['class'=>'control-label required']) !!}
{!! Form::password('password_confirmation', array('id' => 'password_confirmation','maxlength'=>8,'class'=>'form-control required')) !!}
</div>
@if(Request::query('role') ==2) 
<div class="form-group col-sm-6"> 
	{!! Form::label('restaurant_name', 'Restaurant Name:',['class'=>'control-label']) !!}
	{!! Form::text('restaurant_name', $user->restaurant_name ?? '', array('id' => 'restaurant_name','class'=>'form-control')) !!}
</div>
<div class="form-group col-sm-6"> 
	{!! Form::label('vat_no', 'VAT Number:',['class'=>'control-label']) !!}
	{!! Form::text('vat_no', $user->vat_no ?? '', array('id' => 'vat_no','class'=>'form-control')) !!}
</div>

<div class="form-group col-sm-12"> 
	{!! Form::label('address', 'Address:',['class'=>'control-label']) !!}
	{!! Form::textarea('address', $user->address ?? '', array('id' => 'address','class'=>'form-control')) !!}
</div>
@elseif(Request::query('role') ==3)

<div class="form-group col-sm-6"> 
	{!! Form::label('photo', 'Driver Photo:',['class'=>'control-label']) !!}
	{!! Form::file('photo', array('id' => 'driver_photo','class'=>'form-control')) !!}
	@if(!empty($user->userDetail))
	<span>
		<a href="{{ url('storage/images/'.$user->userDetail->photo) }}" alt="" target="_blank" title="">View Photo</a>
	</span>
	@endif
</div>
 

<div class="form-group col-sm-6"> 
	{!! Form::label('licence_file', 'Driver Licence:',['class'=>'control-label']) !!}
	{!! Form::file('licence_file', array('id' => 'licence_file','class'=>'form-control')) !!}
	@if(!empty($user->userDetail))
	<span>
	  <a href="{{ url('storage/images/'.$user->userDetail->licence_file) }}" target="_blank" alt="" title="">{{ $user->userDetail->licence_file }}</a>
	</span>
	@endif

</div>
@endif 
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($user) )
<input data-id="{{$user->id}}" name="status"   type="checkbox" {{ $user->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>

<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>
