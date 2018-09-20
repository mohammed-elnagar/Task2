@extends('layouts.app')
@section('content')

<div class="container">
    <h3>All Companies</h3>
    <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Logo</th>
              <th scope="col">Controle</th>
            </tr>
          </thead>
          <tbody>
            @foreach($companies as $company)
                <tr>
                  <th scope="row">{{$company->id}}</th>
                  <td>{{$company->name}}</td>
                  <td>{{$company->address}}</td>
                  <td>{{$company->logo}}</td>
                  <td><button class="btn btn-warning">Edit </td>
                  <td><button class="btn btn-danger">Delete </td>
                </tr>
            @endforeach
            <tr>
          </tbody>
        </table>
    </div>
    {{$companies->render()}}

</div>

@endsection
