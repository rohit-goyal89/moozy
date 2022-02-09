<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($users)>0)
            @php $counter=1; @endphp
        @foreach($users as $user)
            <tr>
                <td>{{ $counter }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile_no }}</td>

                <td width="120">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('users.show', [$user->id]) }}?role={{Request::query('role')}}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('users.edit', [$user->id]) }}?role={{Request::query('role')}}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @php $counter++; @endphp
        @endforeach
        @else
            <tr>
                <td colspan="5" style="text-align: center;"> No Record Found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
