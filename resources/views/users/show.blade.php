@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(Request::query('role') ==2) 
                     <h1>Restaurant Owner Details</h1>
                    @elseif(Request::query('role') ==3) 
                     <h1>Driver Details</h1>
                    @elseif(Request::query('role') ==4) 
                     <h1>Customer Details</h1> 
                    @endif
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('users.index') }}?role={{Request::query('role')}}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('users.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
