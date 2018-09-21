@extends('layouts.app')
@section('content')

<div class="container">
    <h3>All Companies</h3>
    <a href="{{route('companies.create')}}" class="btn btn-primary mb-3"> Add new company</a>
    <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <!-- <th scope="col">Logo</th> -->
              <th scope="col" >Controle</th>
            </tr>
          </thead>
          <tbody>
            @foreach($companies as $company)
                <tr>
                  <th scope="row">{{$company->id}}</th>
                  <td>{{$company->name}}</td>
                  <td>{{$company->email}}</td>
                  <!-- <td>{{$company->logo}}</td> -->
                  <td><a href="{{route('companies.show', $company->id)}}" class="btn btn-primary btn-sm">Show</a>
                  <a href="{{route('companies.edit', $company->id)}}" class="btn btn-warning btn-sm">Edit</a>
                        <form class="" style="display: inline-block;" action="{{route('companies.destroy', $company->id)}}" method="post">
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
    {{$companies->render()}}

</div>

@endsection
