<!-- Title Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('discount_type', 'Discount Type:') !!}<br>
    {{ Form::radio('type', '1') }} <span>Percentage(%)</span> &nbsp;&nbsp;&nbsp;&nbsp;
    {{ Form::radio('type', '2') }} <span>Amount</span>

</div>
<!-- Discount Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('discount', 'Discount:') !!}
    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6 required"> 
    {!! Form::label('offer_banner', 'Offer Banner:',['class'=>'control-label']) !!}
    {!! Form::file('offer_banner', array('id' => 'offer_banner','class'=>'form-control')) !!}
    @if(!empty($offer->offer_banner))
    <span>
        <a href="{{ url('images/'.$offer->offer_banner) }}" alt="" target="_blank" title="">View Photo</a>
    </span>
    @endif
</div>
<!-- Restaurant Field -->
<div class="form-group col-sm-6 required">
    {!! Form::label('restaurant', 'Restaurants:') !!}
    {!! Form::select('restaurant[]',$restaurants , $selectedRest, ['class' => 'form-control js-example-basic-multiple','multiple'=>"multiple"]) !!}
</div>
<div class="form-group col-sm-6">
{!! Form::label('status', 'Status:',['class'=>'control-label','style'=>'display:block;']) !!}
@if(isset($offer) )
<input data-id="{{$offer->id}}" name="status"   type="checkbox" {{ $offer->status ? 'checked' : '' }}  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@else
<input data-id="0" name="status"   type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on="Active" data-off="InActive">
@endif
</div>
</div>
<div class="row">
<p><strong>Note:</strong> Please upload banner image with all required content to show on page.</p>