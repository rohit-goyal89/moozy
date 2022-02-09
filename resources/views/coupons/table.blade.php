<div class="table-responsive">
    <table class="table" id="coupons-table">
        <thead>
        <tr>
            <th>From Date</th>
            <th>To Date</th>
            <th>Coupon Code</th>
            <th>Discount Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($coupons)>0)
            @foreach($coupons as $coupon)
            <tr>
                <td>{{ date('d/m/Y',strtotime($coupon->from_date)) }}</td>
                <td>{{ date('d/m/Y',strtotime($coupon->to_date)) }}</td>
                <td>{{ $coupon->coupon_code }}</td>
                @if($coupon->discount_type == 1)
                <td>{{ 'Percentage' }}</td>
                @else
                <td>{{ 'Amount' }}</td>
                @endif
                <td>{{ $coupon->amount }}</td>
                 @if($coupon->status == 1)
                <td>{{ 'Active' }}</td>
                @else
                <td>{{ 'InActive' }}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['coupons.destroy', $coupon->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('coupons.show', [$coupon->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('coupons.edit', [$coupon->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        @else
            <tr><td colspan="6" style="text-align:center;">No Record Found</td></tr>
        @endif
        </tbody>
    </table>
</div>
