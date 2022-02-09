<div class="table-responsive">
    <table class="table" id="cuisines-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Description</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($cuisines)>0)
        @foreach($cuisines as $cuisine)
            <tr>
                <td>{{ $cuisine->name }}</td>
            <td>{{ $cuisine->description }}</td>
             @if($cuisine->status == 1)
                <td>{{ 'Active' }}</td>
                @else
                <td>{{ 'InActive' }}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['cuisines.destroy', $cuisine->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cuisines.show', [$cuisine->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cuisines.edit', [$cuisine->id]) }}"
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
                    <td colspan="4" style="text-align:center">No Record Found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
