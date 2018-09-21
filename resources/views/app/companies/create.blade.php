@extends('layouts.app')
@section('content')

<div class="container">
    <a href="{{route('companies.index')}}" class="btn btn-primary">List Companies</a>
    <div class="row justify-content-center">
        <form style="width:70%" class="was-validated" method="post" action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}" enctype="multipart/form-data">
            {!! isset($company) ? '<input type="hidden" name="_method" value="PUT">' : '' !!}
            {{csrf_field()}}
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" id="name"  placeholder="Name" value="{{isset($company) ? $company->name : ''}}">
              @if ($errors->has('name'))
                  <div class="form-control-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{isset($company) ? $company->email : ''}}">
            @if ($errors->has('email'))
                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
            @endif
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{isset($company) ? $company->address : ''}}">
            @if ($errors->has('address'))
                <div class="error">{{ $errors->first('address') }}</div>
            @endif
          </div>
          <div class="form-group has-danger">
            <label for="address">Website</label>
            <input type="text" name="website" class="form-control" id="website" placeholder="Website" value="{{isset($company) ? $company->website : ''}}">
            @if ($errors->has('website'))
                <div class="form-control-feedback">{{ $errors->first('website') }}</div>
            @endif
          </div>
          <div class="form-group has-danger">
              @if(isset($company))
                <div class="" style="    width: 300px; height: 300px; overflow: hidden;">
                    <img src="{{url('/upload/image') .'/' .$company->logo}}" width="100%">
                </div>
              @endif
            <label for="file">File</label>
            <input type="file" name="logo" class="form-control form-control-danger" id="file">
            @if ($errors->has('logo'))
                <div class="form-control-feedback">{{ $errors->first('logo') }}</div>
            @endif
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
