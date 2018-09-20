@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row justify-content-center">
        <form style="width:70%" method="post" action="{{route('companies.store')}}" enctype="multipart/form-data">

            {{csrf_field()}}
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" id="name"  placeholder="Name">
            </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Address">
          </div>
          <div class="form-group">
            <label for="address">Website</label>
            <input type="text" name="website" class="form-control" id="website" placeholder="Website">
          </div>
          <div class="form-group">
            <label for="file">File</label>

            <input type="file" name="logo" class="form-control" id="file">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
