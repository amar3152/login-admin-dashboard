@extends('layouts')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card sm">
        <div class="card-body">
            <div class="card-title">
                Add Employee
            </div>
            <form action="{{url('employee')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Upload Profile</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email"name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" name="mobileno" id="mobileno">
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male"  {{ old('gender', $employee->gender ?? '') == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadioDefault2">
                       Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="female" {{ old('gender', $employee->gender ?? '') == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                </div><br>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
    </div>


@endsection