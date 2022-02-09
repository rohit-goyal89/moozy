<div class="table-responsive">
    <table class="table" id="categories-table">
        <thead>
        <tr>
            <th>Parent Category</th>
            <th>Category</th>
            <th>Status</th>
            <th colspan="3">Action</th> 
        </tr>
        </thead>
        <tbody>
            @if(count($categories))
        @foreach($categories as $category)
            <tr>
                @if($category->parent != null)
                     <td>{{ $category->parent->category }}</td>
                @else 
                     <td>{{ $category->parent_category_id }}</td>
                @endif
                <td>{{ $category->category }}</td>
                 @if($category->status  == 1)
                    <td>{{ "Active" }}</td>
                @else
                    <td>{{ "InActive" }}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('categories.show', [$category->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('categories.edit', [$category->id]) }}"
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
