<div class="table-responsive">
    <table class="table" id="menus-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Type</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($notifications))    
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->type }}</td>
                <td>
                    @if($notification->status == 1) 
                        Active
                    @else
                        Inactive
                    @endif
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['notifications.destroy', $notification->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('notifications.show', [$notification->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
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
