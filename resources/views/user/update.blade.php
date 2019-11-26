@extends('app')

@section('body')
<div class="container">
   <div class="row d-flex justify-content-center mt-4">
      <div class="col-lg-8 col-lg-offset-3">
         <div class="card">
            <div class="card-header float-left" >
               Post an Feed
            </div>
            <div class="card-body">
               <form action="{{route('post.update', $userID)}}" method="POST">
                  @csrf
                  <div class="form-group">
                     <label for="update">Feed Update</label>
                     <input name="update" type="text" class="form-control" id="update" placeholder="Ohayou Sekai!">
                  </div>
                  <button type="submit" class="btn btn-block btn-primary">Post!</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection