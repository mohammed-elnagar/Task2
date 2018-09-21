@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="card card-body">

            <h1>Company - <a href="{{route('companies.show', $employee->company->id)}}">{{$employee->company->name}}</a></h1>
            <h2>Name - {{$employee->name}}</h2>
            <h5>Email - {{$employee->email}}</h5>
            <p>phone - {{$employee->phone}}</p>
        </div>
    </div>
</div>

@endsection
