@extends('layouts.app')
@section('content')

<div class="container">
    <h3>All Employeess</h3>
    <a href="{{route('employees.create')}}" class="btn btn-primary mb-3"> Add new employee</a>
    <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Company Name</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Controle</th>
            </tr>
          </thead>
          <tbody>
            @foreach($employees as $employee)
                <tr>
                  <th scope="row">{{$employee->id}}</th>
                  <td><a href="{{route('companies.show', $employee->company->id)}}">{{$employee->company->name}}</a></td>
                  <td>{{$employee->name}}</td>
                  <td>{{$employee->last_name}}</td>
                  <td><a href="{{route('employees.show', $employee->id)}}" class="btn btn-primary btn-sm">Show</a>
                  <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-warning btn-sm">Edit</a>
                        <form class="" style="display: inline-block;"action="{{route('employees.destroy', $employee->id)}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                   </td>

                </tr>
            @endforeach
            <tr>
          </tbody>
        </table>
    </div>
    {{$employees->render()}}

</div>

@endsection
