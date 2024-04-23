@extends('registration.layouts')
@section('content')
<div class="card-title text-center"><h2>Registration Form</h2></div>
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Upload Profile</label>
                    <input type="file" class="form-control" id="image" name="image">
  </div>

<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{route('login')}}">Login</a>
</form>


@endsection