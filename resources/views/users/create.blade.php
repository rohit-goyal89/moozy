@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @if(Request::query('role') ==2) 
                     <h1>Create Restaurant Owner</h1>
                    @elseif(Request::query('role') ==3) 
                     <h1>Create Driver</h1>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'users.store', 'enctype'=>"multipart/form-data"]) !!}

            <div class="card-body">

                <div class="row">
                    @include('users.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.index') }}?role={{Request::query('role')}}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
