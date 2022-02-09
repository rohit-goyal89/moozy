<div class="table-responsive">
    <table class="table" id="faqs-table">
        <thead>
        <tr>
            <th>Question</th>
        <th>Answer</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($faqs)>0)
        @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->question }}</td>
            <td>{{ $faq->answer }}</td>
             @if($faq->status == 1)
                <td>{{ 'Active' }}</td>
                @else
                <td>{{ 'InActive' }}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['faqs.destroy', $faq->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('faqs.show', [$faq->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('faqs.edit', [$faq->id]) }}"
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
