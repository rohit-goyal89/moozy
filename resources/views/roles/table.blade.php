<div class="table-responsive">
    <table class="table" id="pages-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>

        </tr>
        </thead>
        <tbody>@if(count($roles)>0)
        @foreach($roles as $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <div class='btn-group'>
                    <a class="btn btn-default btn-xs" href="{{ route('roles.show',$role->id) }}"><i class="far fa-eye"></i></a>
                    @can('role-edit')
                        <a class="btn btn-default btn-xs" href="{{ route('roles.edit',$role->id) }}"><i class="far fa-edit"></i></a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    @endcan
                </div>
                </td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="4" style="text-align:center;"> No Record Found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
