<div class="table-responsive">
    <table class="table" id="coupons-table">
        <thead>
        <tr>
            <th>Discount Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($videos)>0)
            @foreach($videos as $video)
            <tr>
                @if($video->discount_type == 1)
                <td>{{ 'Percentage' }}</td>
                @else
                <td>{{ 'Amount' }}</td>
                @endif
                <td>{{ $video->amount }}</td>
                 @if($video->status == 1)
                <td>{{ 'Active' }}</td>
                @else
                <td>{{ 'InActive' }}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['videos.destroy', $video->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('videos.show', [$video->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('videos.edit', [$video->id]) }}"
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
