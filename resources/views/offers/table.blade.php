<div class="table-responsive">
    <table class="table" id="offers-table">
        <thead>
        <tr>
            <th>Offer Type</th>
        <th>Discount</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($offers) > 0)
        @foreach($offers as $offer)
            <tr>
                <td>{{ ($offer->type == 1)?"Percentage(%)":"Amount" }}</td>
                <td>{{ $offer->discount }}</td>
                @if($offer->status == 1) 
                    <td>Active</td>
                @else
                    <td>InActive</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['offers.destroy', $offer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('offers.show', [$offer->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('offers.edit', [$offer->id]) }}"
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
            <tr><td colspan="4" style="text-align:center;">No Record Found</td></tr>
        @endif
        </tbody>
    </table>
</div>
