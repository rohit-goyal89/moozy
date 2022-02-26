<div class="table-responsive">
    <table class="table" id="attributes-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Is Required</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($attributes) > 0)
        @foreach($attributes as $attribute)
            <tr>
                <td>{{ $attribute->name }}</td>
                <td>{{ ($attribute->is_required ==1)?"Yes":"No" }}</td>
                <td>{{ ($attribute->status ==1)?"Active":"Inactive" }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['attributes.destroy', $attribute->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('attributes.show', [$attribute->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('attributes.edit', [$attribute->id]) }}"
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
                <td colspan="5" style="text-align: center;">No Record Found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
{!! $attributes->links() !!}