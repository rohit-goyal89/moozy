@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Restaurant Rating</h1>
                </div>
                <div class="col-sm-6">
                  
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table" id="pages-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Restaurant</th>
                                <th>Rating</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($rating)>0)
                                @foreach($rating as $rat)
                                <tr>
                                    <td>{{ !empty($rat->users)?$rat->users->name:'' }}</td>
                                    <td>{{ !empty($rat->restaurants)?$rat->restaurants->name:'' }}</td>
                                    <td>{{ $rat->rating }}</td>
                                    <td>{{ $rat->comment }}</td>
                                   
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

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

