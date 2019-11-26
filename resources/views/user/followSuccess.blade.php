@extends('app')

@section('body')
<div class="container">
   <div class="row d-flex justify-content-center mt-4">
      <div class="col-lg-4 col-lg-offset-3">
         <div class="card text-center">
            <div class="card-header float-left" >
               People to follow
            </div>
            <div class="card-body">
               <h5 class="card-title">{{$message}} <a href="{{url()->previous()}}">Back to user list</a></h5>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection