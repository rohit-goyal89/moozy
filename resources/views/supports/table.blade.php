<div class="table-responsive">
    <table class="table" id="supports-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Contact</th>
        <th>Is Flag</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($supports) > 0)
        @foreach($supports as $support)
            <tr>
                <td>{{ $support->title }}</td>
                <td>{{ $support->contact }}</td>
                <td>@if($support->is_flag ==0)
                        Email
                     @else
                        Phone
                     @endif   
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['supports.destroy', $support->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('supports.show', [$support->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('supports.edit', [$support->id]) }}"
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
            <tr><td colspan="4" style="text-align:center;">No Record Found!!</td></tr>
        @endif
        </tbody>
    </table>
</div>
