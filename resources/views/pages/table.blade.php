<div class="table-responsive">
    <table class="table" id="pages-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Meta Tag</th>
        <th>Meta Key</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>@if(count($pages)>0)
        @foreach($pages as $page)
            <tr>
            <td>{{ $page->title }}</td>
            <td>{{ $page->meta_tag }}</td>
            <td>{{ $page->meta_key }}</td>
            @if($page->status  == 1)
                <td>{{ "Active" }}</td>
            @else
                <td>{{ "InActive" }}</td>
            @endif
                <td width="120">
                    {!! Form::open(['route' => ['pages.destroy', $page->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pages.show', [$page->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('pages.edit', [$page->id]) }}"
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
                <td colspan="4" style="text-align:center;"> No Record Found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
