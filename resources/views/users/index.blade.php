@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(Request::query('role') ==2) 
                     <h1>Restaurant Owner</h1>
                    @elseif(Request::query('role') ==3) 
                     <h1>Driver</h1>
                    @elseif(Request::query('role') ==4) 
                     <h1>Customer</h1> 
                    @endif
                </div>
                @if(Request::query('role') ==2 || Request::query('role') ==3) 
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('users.create') }}?role={{Request::query('role')}}">
                        Add New
                    </a>
                </div>
                 @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('users.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

