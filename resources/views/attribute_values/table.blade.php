<div class="table-responsive">
    <table class="table" id="attributeValues-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($attributeValues) > 0)
        @foreach($attributeValues as $attributeValue)
            <tr>
                <td>{{ $attributeValue->name }}</td>
                <td>{{ $attributeValue->price }}</td>
                <td>{{ $attributeValue->quantity }}</td>
                <td>{{ ($attributeValue->status ==1)?"Active":"Inactive" }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['attributeValues.destroy', $attributeValue->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('attributeValues.show', [$attributeValue->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('attributeValues.edit', [$attributeValue->id]) }}"
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
            <tr><td colspan="5" style="text-align: center;">No Record Found!!</td></tr>
        @endif
        </tbody>
    </table>
</div>
 {!! $attributeValues->links() !!}