<div class="table-responsive">
    <table class="table" id="restaurants-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Owner Name</th>
            <th>Email</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($restaurants) > 0)
        @foreach($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->name }}</td>
                <td>{{ $restaurant->owner_name }}</td>
                <td>{{ $restaurant->email }}</td>
                @if($restaurant->status  == 1)
                <td>{{ "Active" }}</td>
                @else
                    <td>{{ "InActive" }}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['restaurants.destroy', $restaurant->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('restaurants.show', [$restaurant->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('restaurants.edit', [$restaurant->id]) }}"
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
            <tr>
                <td colspan="4" style="text-align:center;">No Record Found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
