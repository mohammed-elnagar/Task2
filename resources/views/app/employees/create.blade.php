@extends('layouts.app')
@section('content')

<div class="container">
    <a href="{{route('employees.index')}}" class="btn btn-primary">List employees</a>

    <div class="row justify-content-center">
        <form style="width:70%" class="was-validated" method="post" action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" enctype="multipart/form-data">
            {!! isset($employee) ? '<input type="hidden" name="_method" value="PUT">' : '' !!}
            {{csrf_field()}}
            <div class="form-group">
              <label for="exampleFormControlSelect1">Select company</label>
              <select class="form-control" id="exampleFormControlSelect1" name="company_id">
                  @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                  @endforeach
              </select>
            </div>
            @if ($errors->has('employee_id'))
                <div class="form-control-feedback">{{ $errors->first('employee_id') }}</div>
            @endif
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" id="name"  placeholder="Name" value="{{isset($employee) ? $employee->name : ''}}">
              @if ($errors->has('name'))
                  <div class="form-control-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="last_name">LastName</label>
              <input type="text" name="last_name" class="form-control" id="last_name"  placeholder="Last Name" value="{{isset($employee) ? $employee->last_name : ''}}">
              @if ($errors->has('last_name'))
                  <div class="form-control-feedback">{{ $errors->first('last_name') }}</div>
              @endif
            </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{isset($employee) ? $employee->email : ''}}">
            @if ($errors->has('email'))
                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
            @endif
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{isset($employee) ? $employee->phone : ''}}">
            @if ($errors->has('phone'))
                <div class="error">{{ $errors->first('phone') }}</div>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
