@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="card card-body">
            <h2>Name - {{$company->name}}</h2>
            <h5>Email - {{$company->email}}</h5>
            <p>Address - {{$company->address}}</p>
            <a href="{{$company->website}}">Click Here</a>
            <div class="image" style="width:300px; height: 300px">
                <img src="{{url('/upload/image') .'/' .$company->logo}}" style="width:100%; height:100%"alt="">
            </div>
            <div class="">

                @foreach($company->employee() as $employee)
                {{$employee->id}}
                <h2>Name - {{$employee->name}}</h2>
                <h5>Last_name - {{$employee->last_name}}</h5>
                <h5>Email - {{$employee->email}}</h5>
                <p>Phone - {{$employee->phone}}</p>
                @endforeach
            </div>
            {{$company->employee()->render()}}
        </div>
    </div>
</div>

@endsection
