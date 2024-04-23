@extends('admin.layouts')
<style>
    body {
  margin: 3em;
}
.card-img-top {
  width: 60%;
  border-radius: 50%;
  margin: 0 auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.card {
  padding: 1.5em 0.5em 0.5em;
  text-align: center;
  border-radius: 2em;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.card-title {
  font-weight: bold;
  font-size: 1.5em;
}
.btn-primary {
  border-radius: 2em;
  padding: 0.5em 1.5em;
}

</style>
@section('content')
<div class="card mx-auto mt-4"  style="width: 18rem;">

 
  <div class="card-body">
    <h5 class="card-title">{{session('name')}} <br> </h5>
   <!-- <h6> <small>{{session('name')}}</small></h6> -->
    <p class="card-text">
        <strong>{{session('email')}} </strong><br>
        <!-- <strong>{{session('name')}}</strong> -->
    </p>
  </div>
</div>
@endsection