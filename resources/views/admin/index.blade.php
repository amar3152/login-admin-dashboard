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
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card mt-4 col-md-10 mx-5">
    <div class="card-body">
       
        @if($employee->count() > 0)
            <div class="card-text">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Position</td>
                            <td>Email</td>
                            <td>Mobile No</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee as $employees)
                        <tr>
                        <td>{{ ($employee->currentPage() - 1) * $employee->perPage() + $loop->iteration }}</td>
                            <td>{{ $employees->name }}</td>   
                            <td>{{ $employees->position }}</td>   
                            <td>{{ $employees->email }}</td>
                            <td>{{ $employees->mobileno }}</td>
                            <td>
                                <a href="{{ url('/employee/'.$employees->id) }}" class="btn btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ url('/employee/'.$employees->id.'/edit') }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ url('/employee/'.$employees->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                {{$employee->links()}}
            </div>
        @else
            <div class="card-text">
                <p>No employees found.</p>
            </div>
        @endif
    </div>
</div>


@endsection